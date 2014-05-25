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

namespace Ocramius\Report;

/**
 * Help report - a simple (mutable) VO representing a help request
 */
class HelpReport
{
    /**
     * @var string
     */
    private $description = '';

    /**
     * @var array[]
     */
    private $exceptions = [];

    /**
     * @var string[]
     */
    private $affectedFiles = [];

    /**
     * @var string[]
     */
    private $testFiles = [];

    /**
     * @var bool
     */
    private $solved = false;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     * @param array $exception
     */
    public function addException(array $exception)
    {
        $this->exceptions[] = $exception;
    }

    /**
     * @return array[]
     */
    public function getExceptionMessages()
    {
        return $this->exceptions;
    }

    /**
     * @param string $file
     */
    public function addAffectedFile($file)
    {
        $this->affectedFiles[] = (string) $file;
    }

    /**
     * @return string[]
     */
    public function getAffectedFiles()
    {
        return $this->affectedFiles;
    }

    /**
     * @param string $file
     */
    public function addTestFile($file)
    {
        $this->testFiles[] = (string) $file;
    }

    /**
     * @return string[]
     */
    public function getTestFiles()
    {
        return $this->testFiles;
    }

    /**
     * @return boolean
     */
    public function isSolved()
    {
        return $this->solved;
    }

    /**
     * @param boolean $solved
     */
    public function setSolved($solved)
    {
        $this->solved = (bool) $solved;
    }
} 