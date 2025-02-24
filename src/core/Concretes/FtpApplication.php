<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class FtpApplication
{
    use FtpEvent;

    public function __construct(protected string $name)
    {
        $this->init();
    }

    protected function init(): void
    {
        $this
            ->on('starting', function (int $argc, array $argv) {
                fprintf(
                    STDOUT,
                    'Processing %s...'.PHP_EOL,
                    $argc > 1 ? $argv[1] : $argv[0]
                );
            })
            ->on('raise', function (\Throwable $e) {
                fprintf(
                    STDERR,
                    '%s'.PHP_EOL,
                    $e->getMessage()
                );
            })
            ->on('put', function (string $remote, string $local, int $mode = FTP_ASCII) {
                fprintf(
                    STDOUT,
                    'Uploaded %s from %s'.PHP_EOL.str_repeat("\007", 10),
                    $remote,
                    $local
                );
            })
            ->on('get', function (string $remote, string $local) {
                fprintf(
                    STDOUT,
                    'Downloaded %s to %s'.PHP_EOL,
                    $remote,
                    $local
                );
            })
            ->on('mlsd', function (string $path) {
                fprintf(
                    STDOUT,
                    '%s directory accessed'.PHP_EOL,
                    $path
                );
            })
            ->on('mkdir', function (string $dir) {
                fprintf(
                    STDOUT,
                    'Created directory %s'.PHP_EOL,
                    $dir
                );
            })
            ->on('rmdir', function (string $dir) {
                fprintf(
                    STDOUT,
                    'Removed directory %s'.PHP_EOL,
                    $dir
                );
            })
            ->on('help', function (string $command = 'ftp') {
                $usage = <<<'USAGE'
Usage: %s [command] [arguments]
Commands:
    put       Upload files
    get       Download files

USAGE;
                fprintf(STDOUT, $usage, $command);
            })
            ->on('started', function (int $argc, array $argv) {
                fprintf(
                    STDOUT,
                    'Command %s done.'.PHP_EOL,
                    $argc > 1 ? $argv[1] : $argv[0]
                );
                exit(0);
            });
    }

    public function run(int $argc, array $argv): void
    {
        $this->do('starting', $argc, $argv);

        if ($argc !== count($argv)) {
            $this->do('raise', new FtpException('Wrong arguments count', FtpException::INVALID_ARGUMENT));

            return;
        }

        if ($argc < 1) {
            return;
        }

        $name = realpath(array_shift($argv));
        if ($name !== $this->name) {
            $this->do('raise', new FtpException("Unabled to run $this->name as $name"));

            return;
        }
        $argc = count($argv);

        $cwd = getcwd().DIRECTORY_SEPARATOR;

        $ftp_env = new FtpDotenv($cwd.'.env');
        $ftp_env->load();

        $ftp_host = getenv('FTP_HOST');
        $ftp_port = getenv('FTP_PORT');
        $ftp_timeout = getenv('FTP_TIMEOUT');
        $ftp_secure = getenv('FTP_SECURE');
        $ftp_username = getenv('FTP_USERNAME');
        $ftp_password = getenv('FTP_PASSWORD');

        $server = new FtpServer($ftp_host, $ftp_port, $ftp_timeout, $ftp_secure);
        $client = new FtpClient($server, $ftp_username, $ftp_password);
        $server->to($this);
        $client->to($this);

        if ($argc > 1) {
            match ($argv[1]) {
                'put' => $client->put(...array_slice($argv, 2)),
                'get' => $client->get(...array_slice($argv, 2)),
                default => $this->do('help'),
            };
        } else {
            $this->do('help');
        }

        $this->do('started', $argc, $argv);
    }
}
