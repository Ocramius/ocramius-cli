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

namespace Ocramius\Persister;
use Ocramius\Report\HelpReport;

/**
 * Gist uploader - uploads a help report to a gist
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class File
{
    /**
     * @var
     */
    private $dir;

    /**
     * @param string $dir
     */
    public function __construct($dir)
    {
        if (! is_writable($dir)) {
            throw new \BadMethodCallException('Cannot write to this directory!');
        }

        $this->dir = $dir;
    }

    /**
     * Writes the report to disk and returns its path
     *
     * @param HelpReport $report
     *
     * @return string
     */
    public function persist(HelpReport $report)
    {
        $file = uniqid('help-report');

        file_put_contents($this->dir . '/' . $file, json_encode($report));

        return $file;
    }
}
