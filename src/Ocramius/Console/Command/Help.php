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

namespace Ocramius\Console\Command;

use Ocramius\Report\HelpReport;
use Zend\Console\Adapter\AbstractAdapter;
use Zend\Console\ColorInterface;
use Zend\Console\Prompt\Confirm;
use Zend\Console\Prompt\Line;

/**
 * Renders a simple "help" console
 */
class Help
{
    public function help(AbstractAdapter $console)
    {
        $console->write(' ', ColorInterface::YELLOW);
        $console->writeLine('Hi, I\'m Ocramius!');
        $console->writeLine('I\'m here to help you with your problem.');

        $report = new HelpReport();

        if (! $this->loopQuestion([$this, 'askIfHelpIsNeeded'], $console)) {
            $console->writeLine(
                'All good then! Good luck! I will wait for you if you need any help :-D',
                ColorInterface::GREEN
            );

            return;
        }

        if (! $softwareBug = $this->loopQuestion([$this, 'askIfItIsASoftwareBug'], $console)) {
            $console->writeLine(
                'Yeah, about that... I can only help with software bugs. :( I\'ll try to help anyway!!',
                ColorInterface::GRAY
            );
        }

        $report->setSoftwareProblem($softwareBug);

        




    }

    /**
     * @param AbstractAdapter $console
     *
     * @return bool|null
     */
    private function askIfHelpIsNeeded(AbstractAdapter $console)
    {
        return $this->askBooleanQuestion('Are you here to ask for help?', $console);
    }

    /**
     * @param AbstractAdapter $console
     *
     * @return bool|null
     */
    private function askIfItIsASoftwareBug(AbstractAdapter $console)
    {
        return $this->askBooleanQuestion('Is it a software bug?', $console);
    }

    /**
     *
     */
    private function askIfAnErrorIsAvailable()
    {

    }

    private function askBooleanQuestion($question, AbstractAdapter $console)
    {
        $console->writeLine($question . ' [y/n]', ColorInterface::CYAN);

        $prompt = new Confirm('');

        $prompt->setConsole($console);

        return (bool) $prompt->show();
    }

    private function loopQuestion(callable $question, AbstractAdapter $console)
    {
        do {
            $answer = $question($console);
        } while (null === $answer);

        return $answer;
    }
}
