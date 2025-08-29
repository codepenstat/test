import aiohttp
import asyncio
import re
from urllib.parse import urljoin
import json
from typing import List, Dict, Tuple
import argparse
import os

class AsyncCMSDetector:
    def __init__(self, timeout: int = 8):
        self.timeout = timeout
        self.session_headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        }
        
        # Сигнатуры CMS
        self.signatures = {
            'Joomla': {
                'high_confidence': [
                    (r'/index.php\?option=com_', 15),
                    (r'components/com_', 14),
                    (r'modules/mod_', 13),
                    (r'templates/.*joomla', 12),
                ],
                'medium_confidence': [
                    (r'joomla', 8),
                    (r'Joomla!', 9),
                ],
                'files': [
                    ('administrator/index.php', 15),
                    ('administrator/', 13),
                    ('components/com_content/', 14),
                ],
                'headers': [
                    (r'joomla', 10),
                ]
            },
            'WordPress': {
                'high_confidence': [
                    (r'/wp-admin/', 16),
                    (r'/wp-includes/', 15),
                    (r'/wp-content/themes/', 14),
                    (r'/wp-json/wp/v2/', 17),
                    (r'wp-config\.php', 16),
                ],
                'medium_confidence': [
                    (r'wp-content', 12),
                    (r'wordpress', 11),
                    (r'wp-json', 13),
                ],
                'files': [
                    ('wp-login.php', 16),
                    ('wp-admin/', 15),
                    ('xmlrpc.php', 14),
                ],
                'headers': [
                    (r'X-Pingback', 14),
                ]
            },
            'Magento': {
                'high_confidence': [
                    (r'Mage\.', 16),
                    (r'/static/version\d+/', 15),
                    (r'var/view_preprocessed', 15),
                    (r'requirejs-config\.js', 14),
                ],
                'medium_confidence': [
                    (r'magento', 10),
                    (r'Magento_', 12),
                    (r'data-mage-init', 13),
                ],
                'files': [
                    ('admin/', 13),
                    ('index.php/admin/', 14),
                    ('static/frontend/', 15),
                ],
                'headers': [
                    (r'X-Magento', 16),
                    (r'mage-cache-storage', 15),
                ]
            },
            'Shopify': {
                'high_confidence': [
                    (r'cdn\.shopify\.com', 18),
                    (r'window\.Shopify', 17),
                    (r'shopify\\?\\-\\-\\-', 16),
                    (r'__st', 15),
                ],
                'medium_confidence': [
                    (r'shopify', 12),
                    (r'buy-button', 11),
                ],
                'files': [
                    ('cart', 12),
                    ('collections', 12),
                    ('products', 12),
                ],
                'headers': [
                    (r'X-ShopId', 17),
                    (r'X-Shopify', 16),
                    (r'Server: Shopify', 18),
                ]
            },
            'Prestashop': {
                'high_confidence': [
                    (r'/modules/', 15),
                    (r'/themes/', 14),
                    (r'prestashop', 13),
                    (r'ps_.*\.js', 12),
                ],
                'medium_confidence': [
                    (r'prestashop', 10),
                    (r'PS_VERSION', 11),
                ],
                'files': [
                    ('admin/', 13),
                    ('api/', 12),
                    ('themes/default-bootstrap/', 14),
                ],
                'headers': [
                    (r'prestashop', 10),
                ]
            },
            'Opencart': {
                'high_confidence': [
                    (r'/catalog/view/theme/', 15),
                    (r'/system/storage/', 14),
                    (r'opencart', 13),
                    (r'OC_Version', 12),
                ],
                'medium_confidence': [
                    (r'opencart', 10),
                    (r'OpenCart', 11),
                ],
                'files': [
                    ('admin/', 13),
                    ('index.php?route=', 14),
                    ('image/catalog/', 12),
                ],
                'headers': [
                    (r'opencart', 10),
                ]
            }
        }

    async def check_signature(self, content: str, patterns: List[Tuple[str, int]]) -> int:
        """Проверка сигнатур с возвратом весового коэффициента"""
        total_score = 0
        for pattern, weight in patterns:
            if re.search(pattern, content, re.IGNORECASE):
                total_score += weight
        return total_score

    async def check_file_existence(self, session, base_url: str, files: List[Tuple[str, int]]) -> int:
        """Проверка существования файлов с весовыми коэффициентами"""
        total_score = 0
        for file_path, weight in files:
            try:
                test_url = urljoin(base_url, file_path)
                async with session.head(test_url, timeout=self.timeout, allow_redirects=True) as response:
                    if response.status in [200, 301, 302]:
                        total_score += weight
            except Exception:
                continue
        return total_score

    async def check_headers(self, headers: Dict, patterns: List[Tuple[str, int]]) -> int:
        """Проверка заголовков"""
        total_score = 0
        headers_str = ' '.join([f"{k}:{v}" for k, v in headers.items()]).lower()
        for pattern, weight in patterns:
            if re.search(pattern, headers_str, re.IGNORECASE):
                total_score += weight
        return total_score

    async def verify_cms(self, session, domain: str, suspected_cms: str, content: str, headers: Dict) -> Tuple[bool, int]:
        """Дополнительная верификация CMS с возвратом bonus score"""
        bonus_score = 0
        try:
            if suspected_cms == 'WordPress':
                api_url = urljoin(domain, 'wp-json/wp/v2/posts')
                async with session.get(api_url, timeout=3) as response:
                    if response.status == 200:
                        try:
                            data = await response.json()
                            if isinstance(data, list) and len(data) > 0:
                                bonus_score += 20
                                return True, bonus_score
                        except Exception:
                            pass
            elif suspected_cms == 'Shopify':
                shopify_indicators = 0
                if 'X-ShopId' in headers or 'X-Shopify' in headers:
                    shopify_indicators += 1
                if 'cdn.shopify.com' in content:
                    shopify_indicators += 1
                if shopify_indicators >= 2:
                    bonus_score = shopify_indicators * 10
                    return True, bonus_score
            elif suspected_cms == 'Joomla':
                joomla_admin_url = urljoin(domain, 'administrator/index.php')
                async with session.get(joomla_admin_url, timeout=3) as response:
                    if response.status == 200:
                        admin_content = await response.text()
                        if re.search(r'Joomla!', admin_content, re.IGNORECASE):
                            bonus_score += 20
                            return True, bonus_score
            elif suspected_cms == 'Magento':
                magento_api_url = urljoin(domain, 'rest/V1/store/websites')
                async with session.get(magento_api_url, timeout=3) as response:
                    if response.status == 200:
                        try:
                            data = await response.json()
                            if isinstance(data, list) and len(data) > 0:
                                bonus_score += 20
                                return True, bonus_score
                        except Exception:
                            pass
            elif suspected_cms == 'Prestashop':
                prestashop_admin_url = urljoin(domain, 'admin/')
                async with session.head(prestashop_admin_url, timeout=3) as response:
                    if response.status in [200, 301, 302]:
                        bonus_score += 15
                        return True, bonus_score
            elif suspected_cms == 'Opencart':
                opencart_admin_url = urljoin(domain, 'admin/')
                async with session.head(opencart_admin_url, timeout=3) as response:
                    if response.status in [200, 301, 302]:
                        bonus_score += 15
                        return True, bonus_score
        except Exception:
            pass
        return False, bonus_score

    async def detect_single(self, session, domain: str) -> Dict:
        """Асинхронная логика определения CMS"""
        result = {
            'domain': domain,
            'cms': 'Unknown',
            'confidence': 0,
            'scores': {},
            'error': None,
            'response_time': None,
            'status_code': None,
            'verified': False,
            'verification_bonus': 0
        }
        try:
            if not domain.startswith(('http://', 'https://')):
                domain = 'https://' + domain
            
            start_time = asyncio.get_event_loop().time()
            async with session.get(domain, timeout=self.timeout, allow_redirects=True) as response:
                result['response_time'] = round(asyncio.get_event_loop().time() - start_time, 2)
                result['status_code'] = response.status
                
                if response.status != 200:
                    result['error'] = f'HTTP status: {response.status}'
                    return result
                
                content = await response.text()
                headers = response.headers
                
                cms_scores = {}
                for cms_name, cms_data in self.signatures.items():
                    score = 0
                    score += await self.check_signature(content, cms_data['high_confidence'])
                    score += await self.check_file_existence(session, domain, cms_data['files'])
                    score += await self.check_headers(headers, cms_data['headers'])
                    score += await self.check_signature(content, cms_data['medium_confidence'])
                    cms_scores[cms_name] = score
                
                result['scores'] = cms_scores
                
                if cms_scores:
                    best_cms, best_score = max(cms_scores.items(), key=lambda x: x[1])
                    if best_score > 0:
                        is_verified, bonus_score = await self.verify_cms(session, domain, best_cms, content, headers)
                        if is_verified:
                            final_score = best_score + bonus_score
                            result['cms'] = best_cms
                            result['confidence'] = final_score
                            result['verified'] = True
                            result['verification_bonus'] = bonus_score
                        else:
                            result['cms'] = best_cms
                            result['confidence'] = best_score
                            result['verified'] = False
        except Exception as e:
            result['error'] = str(e)
        return result

    async def detect_multiple(self, domains: List[str]) -> List[Dict]:
        """Асинхронная многопоточная проверка"""
        results = []
        async with aiohttp.ClientSession(headers=self.session_headers) as session:
            tasks = [self.detect_single(session, domain) for domain in domains]
            results = await asyncio.gather(*tasks, return_exceptions=True)
        return results

    @staticmethod
    def read_domains_from_file(filename: str) -> List[str]:
        """Чтение доменов из файла"""
        domains = []
        try:
            with open(filename, 'r', encoding='utf-8') as file:
                for line in file:
                    domain = line.strip()
                    if domain and not domain.startswith('#'):
                        domains.append(domain)
        except FileNotFoundError:
            print(f"Ошибка: Файл {filename} не найден!")
            exit(1)
        return domains

    @staticmethod
    def save_results(results: List[Dict], output_file: str):
        """Сохранение результатов"""
        try:
            with open(output_file, 'w', encoding='utf-8') as f:
                json.dump(results, f, ensure_ascii=False, indent=2)
        except Exception as e:
            print(f"Ошибка при сохранении результатов: {e}")

    @staticmethod
    def save_terminal_output(output_file: str, content: str):
        """Сохранение вывода терминала в файл"""
        try:
            with open(output_file, 'a', encoding='utf-8') as f:
                f.write(content + "\n")
        except Exception as e:
            print(f"Ошибка при сохранении вывода терминала: {e}")

    async def analyze_detailed_conflicts(self, results: List[Dict], output_file: str):
        """Детальный анализ результатов"""
        analysis_output = "\n=== Detailed Analysis ===\n"
        print(analysis_output)
        self.save_terminal_output(output_file, analysis_output.strip())

        for result in results:
            if result.get('scores'):
                scores = result['scores']
                sorted_scores = sorted(scores.items(), key=lambda x: x[1], reverse=True)

                if len(sorted_scores) > 1 and sorted_scores[0][1] > 0:
                    domain_analysis = f"\n{result['domain']}:"
                    print(domain_analysis)
                    self.save_terminal_output(output_file, domain_analysis)

                    final_result = f"  Final: {result['cms']} (confidence: {result['confidence']}, verified: {result['verified']})"
                    print(final_result)
                    self.save_terminal_output(output_file, final_result)

                    for cms, score in sorted_scores:
                        if score > 0:
                            cms_score_line = f"  {cms}: {score}"
                            print(cms_score_line)
                            self.save_terminal_output(output_file, cms_score_line)

                    if result['verified'] and result['verification_bonus'] > 0:
                        bonus_line = f"  Verification bonus: +{result['verification_bonus']}"
                        print(bonus_line)
                        self.save_terminal_output(output_file, bonus_line)

    async def main(self):
        parser = argparse.ArgumentParser(description='Async CMS Detector')
        parser.add_argument('-i', '--input', required=True, help='Input file with domains')
        parser.add_argument('-o', '--output', default='async_cms_results.json', help='Output file')
        parser.add_argument('-timeout', type=int, default=8, help='Request timeout')
        
        args = parser.parse_args()
        
        terminal_output_file = "/ftp/webstatics/cms-detector/terminal_output.txt"  # Файл для сохранения вывода терминала
        
        print("Reading domains...")
        self.save_terminal_output(terminal_output_file, "Reading domains...")
        domains = self.read_domains_from_file(args.input)
        print(f"Found {len(domains)} domains")
        self.save_terminal_output(terminal_output_file, f"Found {len(domains)} domains")
        
        detector = AsyncCMSDetector(timeout=args.timeout)
        
        print("Starting async CMS detection...")
        self.save_terminal_output(terminal_output_file, "Starting async CMS detection...")
        results = await detector.detect_multiple(domains)
        
        print(f"Saving results to {args.output}...")
        self.save_terminal_output(terminal_output_file, f"Saving results to {args.output}...")
        self.save_results(results, args.output)
        
        # Статистика
        from collections import Counter
        cms_counter = Counter([r['cms'] for r in results])
        
        print("\n=== Final Statistics ===")
        self.save_terminal_output(terminal_output_file, "\n=== Final Statistics ===")
        for cms, count in cms_counter.most_common():
            verified_count = sum(1 for r in results if r['cms'] == cms and r['verified'])
            stat_line = f"  {cms}: {count} (verified: {verified_count})"
            print(stat_line)
            self.save_terminal_output(terminal_output_file, stat_line)
        
        # Детальный анализ
        await self.analyze_detailed_conflicts(results, terminal_output_file)
        
        print(f"\nResults saved to {args.output}")
        self.save_terminal_output(terminal_output_file, f"\nResults saved to {args.output}")

if __name__ == "__main__":
    detector = AsyncCMSDetector()
    asyncio.run(detector.main())
