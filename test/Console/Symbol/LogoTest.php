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

namespace OcramiusTest\Console\Symbol;

use Ocramius\Console\Symbol\Logo;
use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Console;

/**
 * Tests for {@see \Ocramius\Console\Symbol\Logo}
 *
 * @covers \Ocramius\Console\Symbol\Logo
 */
class LogoTest extends \PHPUnit_Framework_TestCase
{
    public function testDraw()
    {
        /* @var $console AdapterInterface|\PHPUnit_Framework_MockObject_MockObject */
        $console = $this->getMock(AdapterInterface::class);

        $console->expects($this->atLeastOnce())->method('write');
        $console->expects($this->atLeastOnce())->method('writeLine');

        (new Logo())->draw($console);
    }

    /**
     * @coversNothing
     */
    public function testDrawReal()
    {
        $console = Console::getInstance();

        ob_start();
        (new Logo())->draw($console);

        $this->assertNotEmpty(ob_get_contents());
        ob_end_clean();
    }
}
