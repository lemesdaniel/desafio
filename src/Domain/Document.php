<?php

declare(strict_types=1);

namespace App\Domain;

use Psr\Log\InvalidArgumentException;

class Document
{
    private string $document;

    /**
     * @param string $document
     */
    public function __construct(string $document)
    {
        $this->setDocument($document)
            ->sanitize()
            ->checkIfHasOnlyOneCharacter()
            ->validDocument();
    }

    /**
     * @param $document
     * @return $this
     */
    private function setDocument($document): self
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return $this
     */
    private function checkIfHasOnlyOneCharacter(): self
    {
        if (count(array_count_values(str_split($this->document))) == 1) {
            throw new InvalidArgumentException("O documento não é um CPF ou CNPJ válido");
        }
        return $this;
    }

    /**
     * @return $this
     */
    private function sanitize(): self
    {
        $this->document = preg_replace('/[^0-9]/', '', $this->document);
        return $this;
    }

    /**
     * @return bool
     */
    public function validDocument(): bool
    {
        $size = strlen($this->document);
        if ($size != 11 and $size != 14) {
            throw new InvalidArgumentException("O documento não é um CPF ou CNPJ válido");
        }

        if ($size == 11) {
            return $this->cpfIsValid();
        }

        return $this->cnpjIsValid();
    }

    /**
     * @return bool
     */
    private function cpfIsValid(): bool
    {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $this->document[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($this->document[$c] != $d) {
                throw new InvalidArgumentException("O documento não é um CPF válido");
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function cnpjIsValid(): bool
    {
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0, $n = 0; $i < 12; $n += $this->document[$i] * $b[++$i]) {
            ;
        }
        if ($this->document[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            throw new InvalidArgumentException("O documento não é um CNPJ válido");
        }
        for ($i = 0, $n = 0; $i <= 12; $n += $this->document[$i] * $b[$i++]) {
            ;
        }
        if ($this->document[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            throw new InvalidArgumentException("O documento não é um CNPJ válido");
        }
        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->document;
    }

}