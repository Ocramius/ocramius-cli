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
use Zend\Http\Client;
use Zend\Http\Header\ContentType;
use Zend\Http\Request;

/**
 * Gist uploader - uploads a help report to a gist
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class Gist
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {

        $this->client = $client;
    }

    public function persist(HelpReport $report)
    {
        $data = [
            'description' => 'Report generated via Ocramius CLI',
            'files' => [
                'report.json' => [
                    'content' => json_encode($report),
                ],
            ],
            'public' => false,
        ];

        $request = new Request();

        $request->setUri('https://api.github.com/gists');
        $request->setContent(json_encode($data));
        $request->setMethod(Request::METHOD_POST);
        $request->getHeaders()->addHeader(ContentType::fromString('Content-Type: application/json'));
        $request->getHeaders()->addHeaderLine('X-Requested-With: Ocramius CLI');

        $response = $this->client->send($request);

        if (! $response->isSuccess()) {
            throw new \UnexpectedValueException('Could not obtain a valid GIST from the github API');
        }

        $response = json_decode($response->getBody(), true);

        return $response['url'];
    }
}
