<?php

declare(strict_types=1);

namespace Bridget\Concretes;

trait Ftp
{
    use FtpEvent;

    protected $ftp;

    public function open($ftp)
    {
        if (! is_resource($ftp)) {
            $this->do('raise', new FtpException('Cannot open the handle given', FTPException::INVALID_ARGUMENT));
        }
        $this->ftp = $ftp;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (! $this->ftp) {
            $this->do('raise', new FtpException('FTP connection not established', FtpException::NOT_CONNECTED));
        }

        $callback = 'ftp_'.strtolower($name);
        if (! function_exists($callback)) {
            $this->do('raise', new FTPException("Unknow method $name", FtpException::BAD_METHOD));
        }

        return $callback($this->ftp, ...$arguments);
    }

    public function close()
    {
        if ($this->ftp) {
            ftp_close($this->ftp);
        }
    }
}
