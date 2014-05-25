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
use Zend\Console\Adapter\AbstractAdapter as ConsoleAdapter;
use Zend\Console\ColorInterface;
use Zend\Console\Console;
use Zend\Console\Prompt\Confirm;
use Zend\Console\Prompt\Line;
use Zend\Console\Prompt\Number;
use Zend\Validator\Uri;

/**
 * Renders a simple "help" console
 */
class Help
{
    /**
     * Starts interactive support and produces an {@see \Ocramius\Report\HelpReport} once done
     *
     * @param ConsoleAdapter $console
     *
     * @return HelpReport
     */
    public function help(ConsoleAdapter $console)
    {
        $console->write(' ', ColorInterface::YELLOW);
        $console->writeLine('Hi, I\'m Ocramius!');
        $console->writeLine('I\'m here to help you with your programming problem.');
        $console->writeLine('I will just ask you a set of questions, and we\'ll figure something out.');

        $report = new HelpReport();

        $report->setDescription($this->loopQuestion([$this, 'askForProblemDescription'], $console, $report));

        if (!$this->loopQuestion([$this, 'askIfHelpIsNeeded'], $console, $report)) {
            $console->writeLine(
                'All good then! Good luck! I will wait for you if you need any help :-D',
                ColorInterface::GREEN
            );

            return $report;
        }

        if ($this->solveException($console, $report)) {
            $console->writeLine('That is awesome! I guess I can\'t help further than that', ColorInterface::GREEN);

            return $report;
        }

        return $report;
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return string|null
     */
    private function askForProblemDescription(ConsoleAdapter $console)
    {
        return $this->askTextQuestion('Please enter a small description of your problem:', $console);
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return bool|null
     */
    private function askIfHelpIsNeeded(ConsoleAdapter $console)
    {
        return $this->askBooleanQuestion('Are you here to ask for help?', $console);
    }

    /**
     * Ask if an error message is available
     *
     * @param ConsoleAdapter $console
     * @param HelpReport $report
     *
     * @return bool|string[]
     */
    private function solveException(ConsoleAdapter $console, HelpReport $report)
    {
        if (! $this->askBooleanQuestion('Is an exception message available?', $console)) {
            return false;
        }

        do {
            $report->addException([
                'class'   => $this->loopQuestion([$this, 'askForExceptionClass'], $console, $report),
                'message' => $this->loopQuestion([$this, 'askForExceptionMessage'], $console, $report),
                'path'    => $this->loopQuestion([$this, 'askForExceptionPath'], $console, $report),
                'line'    => $this->loopQuestion([$this, 'askForExceptionLine'], $console, $report),
            ]);
        } while ($this->askBooleanQuestion('Are there any previous exceptions?', $console));

        while (! $this->askBooleanQuestion('Did you search for the exception message online?', $console)) {
            $console->writeLine(
                'Please search for the exception message online, then get back here.',
                ColorInterface::GRAY
            );
        }

        if ($this->askBooleanQuestion('Did you find a solution online?', $console)) {
            if ($this->askBooleanQuestion('Can you help me collect the resources you found?', $console)) {
                while (! $this->loopQuestion([$this, 'askForExceptionReference'], $console, $report)) {
                    $console->writeLine(
                        'Please search for the exception message online, then get back here.',
                        ColorInterface::GRAY
                    );
                }
            }

            return true;
        }

        return false;
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return string
     */
    private function askForExceptionClass(ConsoleAdapter $console)
    {
        return $this->askTextQuestion('Please enter the name of the exception class:', $console);
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return string
     */
    private function askForExceptionMessage(ConsoleAdapter $console)
    {
        return $this->askTextQuestion('Please enter the exception message:', $console);
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return string
     */
    private function askForExceptionPath(ConsoleAdapter $console)
    {
        return $this->askFileQuestion('Please enter the path of the file where the exception was thrown:', $console);
    }
    /**
     * @param ConsoleAdapter $console
     *
     * @return string
     */
    private function askForExceptionLine(ConsoleAdapter $console)
    {
        return $this->askNumberQuestion('Please enter the line number at which the exception was thrown:', $console);
    }

    private function askForExceptionReference(ConsoleAdapter $console)
    {
        return $this->askUrlQuestion(
            'Please enter the URL of the documentation/reference/answer that you were able to find for the exception',
            $console
        );
    }

    /**
     * @param $question
     * @param ConsoleAdapter $console
     *
     * @return bool
     */
    private function askBooleanQuestion($question, ConsoleAdapter $console)
    {
        $console->write($question . ' ', ColorInterface::CYAN);
        $console->writeLine('[y/n]', ColorInterface::GREEN);

        $prompt = new Confirm('');

        $prompt->setConsole($console);

        return (bool) $prompt->show();
    }

    /**
     * @param $question
     * @param ConsoleAdapter $console
     *
     * @return string|null
     */
    private function askTextQuestion($question, ConsoleAdapter $console)
    {
        $console->writeLine($question . ' (in 1 line)', ColorInterface::CYAN);

        $prompt = new Line('');

        $prompt->setConsole($console);

        $result = $prompt->show();

        return ((bool) (string) $result) ? (string) $result : null;
    }

    /**
     * @param $question
     * @param ConsoleAdapter $console
     *
     * @return string|null
     */
    private function askNumberQuestion($question, ConsoleAdapter $console)
    {
        $console->writeLine($question . ' ([0-9]+)', ColorInterface::CYAN);

        $prompt = new Number('');

        $prompt->setConsole($console);

        $result = $prompt->show();

        return is_numeric($result) ? $result : null;
    }

    /**
     * @param $question
     * @param ConsoleAdapter $console
     *
     * @return string|null
     */
    private function askFileQuestion($question, ConsoleAdapter $console)
    {
        $console->writeLine($question . ' (file path)', ColorInterface::CYAN);

        $prompt = new Line('');

        $prompt->setConsole($console);

        $path = $prompt->show();

        if (! is_file($path)) {
            $console->writeLine('The file "' . $path . '" does not seem to exist!', ColorInterface::RED);

            return null;
        }

        if (! is_readable($path)) {
            $console->writeLine('I cannot read the file "' . $path . '"!', ColorInterface::RED);

            return null;
        }

        return realpath($path);
    }

    /**
     * @param $question
     * @param ConsoleAdapter $console
     *
     * @return string|null
     */
    private function askUrlQuestion($question, ConsoleAdapter $console)
    {
        $console->writeLine($question . ' (URL)', ColorInterface::CYAN);

        $prompt = new Line('');

        $prompt->setConsole($console);

        $url = $prompt->show();

        if (!(new Uri())->isValid($url)) {
            $console->writeLine('The provided URL "' . $url . '" doesn\'t seem to be valid!', ColorInterface::RED);

            return null;
        }

        return $url;
    }

    /**
     * @param callable        $question
     * @param ConsoleAdapter $console
     * @param HelpReport      $report
     *
     * @return mixed
     */
    private function loopQuestion(callable $question, ConsoleAdapter $console, HelpReport $report)
    {
        do {
            $answer = $question($console, $report);
        } while (null === $answer);

        return $answer;
    }
}
