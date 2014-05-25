<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Ocramius\Console\Symbol;

use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\Console\ColorInterface;

/**
 * The Ocramius Super-Mario image
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class Logo
{
    const DOT_WIDTH_MULTIPLIER = 2;

    const BLACK         = ColorInterface::BLACK;
    const WHITE         = ColorInterface::WHITE;
    const BROWN         = ColorInterface::GRAY;
    const MAGENTA       = ColorInterface::MAGENTA;
    const YELLOW        = ColorInterface::YELLOW;
    const CYAN          = ColorInterface::CYAN;
    const BLUE          = ColorInterface::BLUE;
    const LIGHT_YELLOW  = ColorInterface::LIGHT_YELLOW;
    const LIGHT_MAGENTA = ColorInterface::LIGHT_MAGENTA;
    const LIGHT_PINK    = ColorInterface::LIGHT_MAGENTA;
    const LIGHT_RED     = ColorInterface::LIGHT_RED;
    const LIGHT_BLUE    = ColorInterface::LIGHT_BLUE;
    const LIGHT_CYAN    = ColorInterface::LIGHT_CYAN;
    const LIGHT_BROWN   = ColorInterface::LIGHT_WHITE;

    private $dots = [
        [],
        [],
        [
            [10],
            [5, self::BROWN],
        ],
        [
            [9],
            [1, self::BROWN],
            [2, self::LIGHT_MAGENTA],
            [1, self::LIGHT_YELLOW],
            [2, self::LIGHT_MAGENTA],
            [2, self::BROWN],
        ],
        [
            [9],
            [1, self::BROWN],
            [1, self::MAGENTA],
            [1, self::WHITE],
            [1, self::LIGHT_YELLOW],
            [1, self::YELLOW],
            [1, self::MAGENTA],
            [2, self::LIGHT_MAGENTA],
            [1, self::BROWN],
        ],
        [
            [8],
            [7, self::BLACK],
            [2, self::MAGENTA],
            [1, self::LIGHT_MAGENTA],
            [1, self::BROWN],
        ],
        [
            [7],
            [10, self::BLACK],
            [1, self::MAGENTA],
            [1, self::LIGHT_MAGENTA],
            [1, self::BROWN],
        ],
        [
            [7],
            [11, self::BLACK],
            [2, self::MAGENTA],
            [1, self::BROWN],
        ],
        [
            [8],
            [2, self::BLACK],
            [2, self::WHITE],
            [1, self::LIGHT_RED],
            [2, self::WHITE],
            [1, self::LIGHT_RED],
            [2, self::BLACK],
            [2, self::MAGENTA],
            [1, self::BROWN],
        ],
        [
            [10],
            [1, self::WHITE],
            [1, self::BLACK],
            [1, self::LIGHT_PINK],
            [1, self::BLACK],
            [1, self::WHITE],
            [2, self::LIGHT_RED],
            [2, self::BLACK],
            [2, self::LIGHT_PINK],
            [1, self::LIGHT_RED],
        ],
        [
            [8],
            [1, self::LIGHT_BROWN],
            [1, self::LIGHT_PINK],
            [1, self::WHITE],
            [1, self::BLACK],
            [1, self::LIGHT_PINK],
            [1, self::BLACK],
            [1, self::WHITE],
            [1, self::LIGHT_PINK],
            [1, self::LIGHT_RED],
            [2, self::BLACK],
            [1, self::LIGHT_PINK],
            [1, self::LIGHT_BROWN],
            [1, self::LIGHT_RED],
        ],
        [
            [8],
            [1, self::LIGHT_BROWN],
            [3, self::LIGHT_PINK],
            [2, self::LIGHT_RED],
            [2, self::LIGHT_PINK],
            [3, self::BLACK],
            [1, self::LIGHT_RED],
            [1, self::LIGHT_BROWN],
            [1, self::LIGHT_RED],
        ],
        [
            [8],
            [1, self::LIGHT_BROWN],
            [4, self::LIGHT_MAGENTA],
            [1, self::LIGHT_BROWN],
            [1, self::BLACK],
            [2, self::LIGHT_PINK],
            [1, self::BLACK],
            [3, self::LIGHT_RED],
            [4, self::BROWN],
        ],
        [
            [7],
            [9, self::BLACK],
            [3, self::LIGHT_RED],
            [2, self::BLACK],
            [4, self::YELLOW],
            [2, self::BROWN],
        ],
        [
            [8],
            [6, self::BLACK],
            [2, self::LIGHT_PINK],
            [2, self::LIGHT_RED],
            [2, self::BLACK],
            [1, self::LIGHT_RED],
            [4, self::BROWN],
            [2, self::YELLOW],
            [1, self::BROWN],
        ],
        [
            [7],
            [4, self::LIGHT_BROWN],
            [6, self::LIGHT_RED],
            [1, self::LIGHT_BROWN],
            [1, self::BLACK],
            [2, self::BROWN],
            [3, self::LIGHT_BROWN],
            [3, self::BROWN],
            [1, self::YELLOW],
            [1, self::BROWN],
        ],
        [
            [6],
            [1, self::LIGHT_BROWN],
            [1, self::WHITE],
            [1, self::LIGHT_BROWN],
            [1, self::WHITE],
            [3, self::LIGHT_BROWN],
            [2, self::BROWN],
            [6, self::MAGENTA],
            [1, self::BROWN],
            [5, self::LIGHT_BROWN],
            [1, self::BROWN],
            [1, self::YELLOW],
            [1, self::BROWN],
        ],
        [
            [6],
            [1, self::LIGHT_BROWN],
            [2, self::WHITE],
            [1, self::LIGHT_BROWN],
            [1, self::WHITE],
            [1, self::BLUE],
            [2, self::LIGHT_MAGENTA],
            [2, self::BLUE],
            [4, self::LIGHT_MAGENTA],
            [1, self::MAGENTA],
            [1, self::BROWN],
            [6, self::LIGHT_BROWN],
            [2, self::BROWN],
        ],
        [
            [6],
            [1, self::LIGHT_BROWN],
            [2, self::WHITE],
            [1, self::LIGHT_BROWN],
            [1, self::CYAN],
            [2, self::MAGENTA],
            [2, self::CYAN],
            [2, self::MAGENTA],
            [3, self::LIGHT_BROWN],
            [1, self::MAGENTA],
            [1, self::BROWN],
            [8, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [7],
            [1, self::LIGHT_CYAN],
            [2, self::BROWN],
            [2, self::LIGHT_CYAN],
            [2, self::BROWN],
            [2, self::LIGHT_BROWN],
            [2, self::WHITE],
            [1, self::LIGHT_BROWN],
            [1, self::BROWN],
            [8, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [8],
            [1, self::BLUE],
            [1, self::WHITE],
            [2, self::LIGHT_CYAN],
            [2, self::WHITE],
            [1, self::LIGHT_CYAN],
            [1, self::LIGHT_BROWN],
            [5, self::WHITE],
            [9, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [7],
            [2, self::LIGHT_BROWN],
            [1, self::BLUE],
            [1, self::WHITE],
            [2, self::LIGHT_CYAN],
            [2, self::WHITE],
            [1, self::LIGHT_CYAN],
            [1, self::LIGHT_BROWN],
            [5, self::WHITE],
            [10, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [6],
            [1, self::BLACK],
            [1, self::LIGHT_BROWN],
            [1, self::LIGHT_YELLOW],
            [1, self::LIGHT_BROWN],
            [1, self::BLUE],
            [5, self::LIGHT_CYAN],
            [1, self::LIGHT_BROWN],
            [3, self::WHITE],
            [1, self::LIGHT_BROWN],
            [1, self::WHITE],
            [1, self::BROWN],
            [8, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [6],
            [2, self::BLACK],
            [3, self::LIGHT_BROWN],
            [1, self::BLUE],
            [3, self::LIGHT_CYAN],
            [2, self::CYAN],
            [3, self::LIGHT_BROWN],
            [1, self::BLACK],
            [1, self::WHITE],
            [1, self::BROWN],
            [1, self::LIGHT_BROWN],
            [5, self::BROWN],
            [2, self::LIGHT_BROWN],
            [1, self::BROWN],
        ],
        [
            [6],
            [2, self::BLACK],
            [3, self::LIGHT_BROWN],
            [1, self::BLUE],
            [5, self::CYAN],
            [2, self::BLACK],
            [2, self::LIGHT_BROWN],
            [1, self::BLACK],
            [2, self::BROWN],
            [5, self::WHITE],
            [3, self::BROWN],
        ],
        [
            [7],
            [2, self::BLACK],
            [2, self::LIGHT_BROWN],
            [8, self::BLUE],
            [2, self::LIGHT_BROWN],
            [1, self::BLACK],
        ],
        [
            [7],
            [3, self::BLACK],
            [1, self::LIGHT_BROWN],
            [4],
            [2, self::BLUE],
            [2, self::LIGHT_BROWN],
            [1, self::LIGHT_YELLOW],
            [1, self::LIGHT_BROWN],
            [1, self::BLACK],
        ],
        [
            [8],
            [2, self::BLACK],
            [7],
            [2, self::BLACK],
            [2, self::LIGHT_BROWN],
            [1, self::BLACK],
        ],
        [
            [8],
            [2, self::BLACK],
            [7],
            [2, self::BLACK],
            [2, self::LIGHT_BROWN],
            [1, self::BLACK],
        ],
        [
            [19],
            [2, self::BLACK],
        ],
    ];

    /**
     * Draw the logo to the given console
     *
     * @param ConsoleAdapter $console
     *
     * @return void
     */
    public function draw(ConsoleAdapter $console)
    {
        $this->drawLines($console);
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return void
     */
    private function drawLines(ConsoleAdapter $console)
    {
        array_map(
            function (array $line) use ($console) {
                $this->drawLine($console, $line);
            },
            $this->dots
        );
    }

    /**
     * @param ConsoleAdapter $console
     * @param array $line
     *
     * @return void
     */
    private function drawLine(ConsoleAdapter $console, array $line)
    {
        $remainingLength = $this->getWidth();

        foreach ($line as $dots) {
            $bgColor         = isset($dots[1]) ? $dots[1] : null;
            $color           = isset($dots[2]) ? $dots[2] : null;
            $remainingLength -= $dots[0] * static::DOT_WIDTH_MULTIPLIER;

            $console->write(str_repeat(' ', $dots[0] * static::DOT_WIDTH_MULTIPLIER), $color, $bgColor);
        }

        $console->write(str_repeat(' ', $remainingLength));
        $console->writeLine();
    }

    /**
     * Retrieve the max width, based on all lines
     *
     * @return int
     */
    private function getWidth()
    {
        $max = 0;

        foreach ($this->dots as $line) {
            $length = 0;

            foreach ($line as $chars) {
                $length += $chars[0] * static::DOT_WIDTH_MULTIPLIER;
            }

            $max = max($length, $max);
        }

        return $max;
    }
}
