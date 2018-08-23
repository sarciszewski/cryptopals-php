<?php
declare(strict_types=1);
namespace Sarciszewski\Cryptopals\Set5;

use Sarciszewski\Cryptopals\Common\SolutionInterface;

/**
 * Class Challenge33
 *
 * @package Sarciszewski\Cryptopals\Set5
 */
class Challenge33 implements SolutionInterface
{
    public function __invoke()
    {
        $this->elementary();
        $this->nist();
    }

    /**
     * @throws \Exception
     */
    public function elementary()
    {
        $p = \gmp_init(37);
        $g = \gmp_init(5, 10);

        $a = \random_int(0, 36);
        $A = \gmp_powm($g, $a, $p);

        $b = \random_int(0, 36);
        $B = \gmp_powm($g, $b, $p);

        /** @var \GMP $aB */
        $aB = \gmp_powm($B, $a, $p);
        /** @var \GMP $bA */
        $bA = \gmp_powm($A, $b, $p);

        if (\gmp_strval($aB) === \gmp_strval($bA)) {
            echo 'Elementary implementation is OK.', PHP_EOL;
        } else {
            var_dump(\gmp_strval($aB), \gmp_strval($bA));
            echo 'Elementary implementation is broken!', PHP_EOL;
            exit(255);
        }
    }

    /**
     * @throws \Exception
     */
    public function nist()
    {
        $p = \gmp_init(
            "ffffffffffffffffc90fdaa22168c234c4c6628b80dc1cd129024e088a67cc74" .
            "020bbea63b139b22514a08798e3404ddef9519b3cd3a431b30" .
            "2b0a6df25f14374fe1356d6d51c245e485b576625e7ec6f44c" .
            "42e9a637ed6b0bff5cb6f406b7edee386bfb5a899fa5ae9f24" .
            "117c4b1fe649286651ece45b3dc2007cb8a163bf0598da4836" .
            "1c55d39a69163fa8fd24cf5f83655d23dca3ad961c62f35620" .
            "8552bb9ed529077096966d670c354e4abc9804f1746c08ca23" .
            "7327ffffffffffffffff",
            16
        );
        $g = gmp_init(2, 10);

        $a = \random_int(0, PHP_INT_MAX);
        $A = \gmp_powm($g, $a, $p);

        $b = \random_int(0, PHP_INT_MAX);
        $B = \gmp_powm($g, $b, $p);

        /** @var \GMP $aB */
        $aB = \gmp_powm($B, $a, $p);
        /** @var \GMP $bA */
        $bA = \gmp_powm($A, $b, $p);

        if (\gmp_strval($aB) === \gmp_strval($bA)) {
            echo 'NIST implementation is OK.', PHP_EOL;
        } else {
            var_dump(\gmp_strval($aB), \gmp_strval($bA));
            echo 'NIST implementation is broken!', PHP_EOL;
            exit(255);
        }
    }
}
