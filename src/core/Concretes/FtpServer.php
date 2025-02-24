<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class FtpServer
{
    use Ftp;

    public function __construct($host, int $port = 21, int $timeout = 90, bool $secure = false)
    {
        is_string($host) ? $this->connect($host, $port, $timeout, $secure) : $this->open($host);
    }

    public function connect(string $host, int $port = 21, int $timeout = 90, $secure = false): self
    {
        if (! ($ftp = $secure ? ftp_ssl_connect($host, $port, $timeout) : ftp_connect($host, $port, $timeout))) {
            $this->do('raise', new FtpException("Failed to connect to $host:$port", FtpException::CONNECTION_FAILURE));
        }
        $this->open($ftp);

        return $this;
    }

    protected $client;

    public function login(string $username, string $password): FtpClient
    {
        if (! ($this->client = new FtpClient($this, $username, $password))) {
            $this->do('raise', new FtpException("Failed to login $username", FtpException::LOGIN_FAILURE));
        }

        return $this->client;
    }

    public function __destruct()
    {
        $this->close();
    }
}
