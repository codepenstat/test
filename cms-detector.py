import requests
import re
from urllib.parse import urljoin
import concurrent.futures
import time
import json
from typing import List, Dict, Tuple
import argparse

class CorrectedCMSDetector:
    def __init__(self, timeout: int = 8, max_workers: int = 10):
        self.timeout = timeout
        self.max_workers = max_workers
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        })
        
        # Обновленные сигнатуры с более точными весами
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
            'Prestashop': {  # Новый блок для Prestashop
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
            'Opencart': {  # Новый блок для Opencart
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
    
    def check_signature(self, content: str, patterns: List[Tuple[str, int]]) -> int:
        """Проверка сигнатур с возвратом весового коэффициента"""
        total_score = 0
        for pattern, weight in patterns:
            if re.search(pattern, content, re.IGNORECASE):
                total_score += weight
        return total_score
    
    def check_file_existence(self, base_url: str, files: List[Tuple[str, int]]) -> int:
        """Проверка существования файлов с весовыми коэффициентами"""
        total_score = 0
        for file_path, weight in files:
            try:
                test_url = urljoin(base_url, file_path)
                response = self.session.head(test_url, timeout=3, allow_redirects=True)
                if response.status_code in [200, 301, 302]:
                    total_score += weight
            except:
                continue
        return total_score
    
    def check_headers(self, headers: Dict, patterns: List[Tuple[str, int]]) -> int:
        """Проверка заголовков"""
        total_score = 0
        headers_str = ' '.join([f"{k}:{v}" for k, v in headers.items()]).lower()
        
        for pattern, weight in patterns:
            if re.search(pattern, headers_str, re.IGNORECASE):
                total_score += weight
        return total_score
    
    def verify_cms(self, domain: str, suspected_cms: str, content: str, headers: Dict) -> Tuple[bool, int]:
        """Дополнительная верификация CMS с возвратом bonus score"""
        bonus_score = 0
        
        try:
            if suspected_cms == 'WordPress':
                # Проверка WordPress REST API
                api_url = urljoin(domain, 'wp-json/wp/v2/posts')
                response = self.session.get(api_url, timeout=3)
                if response.status_code == 200:
                    try:
                        data = response.json()
                        if isinstance(data, list) and len(data) > 0:
                            bonus_score += 20
                            return True, bonus_score
                    except:
                        pass
                
                # Проверка readme.html
                readme_url = urljoin(domain, 'readme.html')
                response = self.session.get(readme_url, timeout=3)
                if response.status_code == 200 and 'wordpress' in response.text.lower():
                    bonus_score += 15
                    return True, bonus_score
            
            elif suspected_cms == 'Shopify':
                # Shopify verification - должна быть очень строгой
                shopify_indicators = 0
                
                # Проверка заголовков Shopify
                if 'X-ShopId' in headers or 'X-Shopify' in headers:
                    shopify_indicators += 1
                
                # Проверка CDN в контенте
                if 'cdn.shopify.com' in content:
                    shopify_indicators += 1
                
                # Проверка Liquid templates
                if '{{' in content and '}}' in content and 'product.' in content:
                    shopify_indicators += 1
                
                # Проверка window.Shopify
                if 'window.Shopify' in content or 'Shopify.' in content:
                    shopify_indicators += 1
                
                # Только если есть минимум 3 подтверждения
                if shopify_indicators >= 3:
                    bonus_score = shopify_indicators * 10
                    return True, bonus_score
            
            elif suspected_cms == 'Magento':
                # Проверка Magento
                magento_indicators = 0
                
                # Проверка заголовков
                if any('magento' in str(v).lower() for k, v in headers.items() if k.lower() in ['x-magento', 'mage-cache-storage']):
                    magento_indicators += 1
                
                # Проверка статических файлов
                static_url = urljoin(domain, 'static/version')
                response = self.session.head(static_url, timeout=3)
                if response.status_code in [200, 301, 302]:
                    magento_indicators += 1
                
                # Проверка JavaScript объектов Magento
                if 'Mage.' in content or 'Magento_' in content:
                    magento_indicators += 1
                
                if magento_indicators >= 2:
                    bonus_score = magento_indicators * 12
                    return True, bonus_score
            
            elif suspected_cms == 'Prestashop':
                # Проверка Prestashop
                prestashop_indicators = 0
                
                # Проверка заголовков
                if 'prestashop' in headers.get('server', '').lower():
                    prestashop_indicators += 1
                
                # Проверка характерных файлов
                modules_url = urljoin(domain, 'modules/')
                response = self.session.head(modules_url, timeout=3)
                if response.status_code in [200, 301, 302]:
                    prestashop_indicators += 1
                
                # Проверка JS файлов
                if 'PS_VERSION' in content:
                    prestashop_indicators += 1
                
                if prestashop_indicators >= 2:
                    bonus_score = prestashop_indicators * 12
                    return True, bonus_score
            
            elif suspected_cms == 'Opencart':
                # Проверка Opencart
                opencart_indicators = 0
                
                # Проверка заголовков
                if 'opencart' in headers.get('server', '').lower():
                    opencart_indicators += 1
                
                # Проверка характерных файлов
                catalog_url = urljoin(domain, 'catalog/view/theme/')
                response = self.session.head(catalog_url, timeout=3)
                if response.status_code in [200, 301, 302]:
                    opencart_indicators += 1
                
                # Проверка JS файлов
                if 'OC_Version' in content:
                    opencart_indicators += 1
                
                if opencart_indicators >= 2:
                    bonus_score = opencart_indicators * 12
                    return True, bonus_score
        
        except Exception as e:
            pass
        
        return False, bonus_score
    
    def detect_single(self, domain: str) -> Dict:
        """Исправленная логика определения CMS"""
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
            
            start_time = time.time()
            response = self.session.get(domain, timeout=self.timeout, allow_redirects=True)
            result['response_time'] = round(time.time() - start_time, 2)
            result['status_code'] = response.status_code
            
            if response.status_code != 200:
                result['error'] = f'HTTP status: {response.status_code}'
                return result
            
            content = response.text
            headers = response.headers
            
            # Собираем оценки для каждой CMS
            cms_scores = {}
            
            for cms_name, cms_data in self.signatures.items():
                score = 0
                
                # Проверка высокоприоритетных сигнатур
                score += self.check_signature(content, cms_data['high_confidence'])
                
                # Проверка файлов
                score += self.check_file_existence(domain, cms_data['files'])
                
                # Проверка заголовков
                score += self.check_headers(headers, cms_data['headers'])
                
                # Проверка средних сигнатур
                score += self.check_signature(content, cms_data['medium_confidence'])
                
                cms_scores[cms_name] = score
            
            result['scores'] = cms_scores
            
            # Определяем CMS с наибольшим score
            if cms_scores:
                best_cms, best_score = max(cms_scores.items(), key=lambda x: x[1])
                
                if best_score > 0:
                    # Верифицируем лучшую CMS
                    is_verified, bonus_score = self.verify_cms(domain, best_cms, content, headers)
                    
                    # ТОЛЬКО ЕСЛИ верификация успешна, применяем бонус
                    if is_verified:
                        final_score = best_score + bonus_score
                        result['cms'] = best_cms
                        result['confidence'] = final_score
                        result['verified'] = True
                        result['verification_bonus'] = bonus_score
                    else:
                        # Если верификация не пройдена, ищем альтернативы
                        alternative_found = False
                        for cms_name, score in sorted(cms_scores.items(), key=lambda x: x[1], reverse=True):
                            if cms_name != best_cms and score > 0:
                                is_alt_verified, alt_bonus = self.verify_cms(domain, cms_name, content, headers)
                                if is_alt_verified:
                                    result['cms'] = cms_name
                                    result['confidence'] = score + alt_bonus
                                    result['verified'] = True
                                    result['verification_bonus'] = alt_bonus
                                    alternative_found = True
                                    break
                        
                        # Если альтернатива не найдена, используем лучший score без верификации
                        if not alternative_found:
                            result['cms'] = best_cms
                            result['confidence'] = best_score
                            result['verified'] = False
            
        except Exception as e:
            result['error'] = str(e)
        
        return result

    def detect_multiple(self, domains: List[str]) -> List[Dict]:
        """Многопоточная проверка"""
        results = []
        
        with concurrent.futures.ThreadPoolExecutor(max_workers=self.max_workers) as executor:
            future_to_domain = {
                executor.submit(self.detect_single, domain): domain 
                for domain in domains
            }
            
            for future in concurrent.futures.as_completed(future_to_domain):
                try:
                    result = future.result()
                    results.append(result)
                    
                    status = "✓" if result['verified'] else "?"
                    bonus = f"+{result['verification_bonus']}" if result['verified'] else ""
                    print(f"{status} {result['domain']} -> {result['cms']} (score: {result['confidence']}{bonus})")
                    
                except Exception as e:
                    results.append({
                        'domain': future_to_domain[future],
                        'cms': 'Unknown',
                        'error': str(e),
                        'response_time': None,
                        'status_code': None,
                        'verified': False,
                        'verification_bonus': 0
                    })
        
        return results

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

def save_results(results: List[Dict], output_file: str):
    """Сохранение результатов"""
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(results, f, ensure_ascii=False, indent=2)

def analyze_detailed_conflicts(results: List[Dict], output_file: str):
    """Детальный анализ результатов"""
    analysis_output = "\n=== Detailed Analysis ===\n"
    print(analysis_output)
    save_terminal_output(output_file, analysis_output.strip())  # Сохраняем заголовок анализа

    for result in results:
        if result.get('scores'):
            scores = result['scores']
            sorted_scores = sorted(scores.items(), key=lambda x: x[1], reverse=True)

            if len(sorted_scores) > 1 and sorted_scores[0][1] > 0:
                domain_analysis = f"\n{result['domain']}:"
                print(domain_analysis)
                save_terminal_output(output_file, domain_analysis)

                final_result = f"  Final: {result['cms']} (confidence: {result['confidence']}, verified: {result['verified']})"
                print(final_result)
                save_terminal_output(output_file, final_result)

                for cms, score in sorted_scores:
                    if score > 0:
                        cms_score_line = f"  {cms}: {score}"
                        print(cms_score_line)
                        save_terminal_output(output_file, cms_score_line)

                if result['verified'] and result['verification_bonus'] > 0:
                    bonus_line = f"  Verification bonus: +{result['verification_bonus']}"
                    print(bonus_line)
                    save_terminal_output(output_file, bonus_line)

def save_terminal_output(output_file: str, content: str):
    """Сохранение вывода терминала в файл"""
    with open(output_file, 'a', encoding='utf-8') as f:
        f.write(content + "\n")

def main():
    parser = argparse.ArgumentParser(description='Corrected CMS Detector')
    parser.add_argument('-i', '--input', required=True, help='Input file with domains')
    parser.add_argument('-o', '--output', default='corrected_cms_results.json', help='Output file')
    parser.add_argument('-t', '--threads', type=int, default=8, help='Number of threads')
    parser.add_argument('-timeout', type=int, default=8, help='Request timeout')
    
    args = parser.parse_args()
    
    terminal_output_file = "/ftp/webstatics/cms-detector/terminal_output.txt"  # Файл для сохранения вывода терминала
    
    print("Reading domains...")
    save_terminal_output(terminal_output_file, "Reading domains...")
    domains = read_domains_from_file(args.input)
    print(f"Found {len(domains)} domains")
    save_terminal_output(terminal_output_file, f"Found {len(domains)} domains")
    
    detector = CorrectedCMSDetector(timeout=args.timeout, max_workers=args.threads)
    
    print("Starting corrected CMS detection...")
    save_terminal_output(terminal_output_file, "Starting corrected CMS detection...")
    results = detector.detect_multiple(domains)
    
    print(f"Saving results to {args.output}...")
    save_terminal_output(terminal_output_file, f"Saving results to {args.output}...")
    save_results(results, args.output)
    
    # Статистика
    from collections import Counter
    cms_counter = Counter([r['cms'] for r in results])
    
    print("\n=== Final Statistics ===")
    save_terminal_output(terminal_output_file, "\n=== Final Statistics ===")
    for cms, count in cms_counter.most_common():
        verified_count = sum(1 for r in results if r['cms'] == cms and r['verified'])
        stat_line = f"  {cms}: {count} (verified: {verified_count})"
        print(stat_line)
        save_terminal_output(terminal_output_file, stat_line)
    
    # Детальный анализ
    analyze_detailed_conflicts(results, terminal_output_file)
    
    print(f"\nResults saved to {args.output}")
    save_terminal_output(terminal_output_file, f"\nResults saved to {args.output}")

if __name__ == "__main__":
    main()
