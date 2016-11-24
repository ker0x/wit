<?php
namespace Kerox\Wit\Request;

use Kerox\Wit\Model\Entity;
use Kerox\Wit\Model\Entity\Expression;
use Kerox\Wit\Model\Entity\Value;

class EntitiesRequest extends AbstractRequest
{

    /**
     * @var null|mixed
     */
    protected $body;

    /**
     * EntitiesRequest constructor.
     *
     * @param string $accessToken
     * @param mixed $body
     */
    public function __construct(string $accessToken, $body = null)
    {
        parent::__construct($accessToken);

        $this->isValidBody($body);

        $this->body = $body;
    }

    /**
     * @return array
     */
    protected function buildHeaders(): array
    {
        return parent::buildHeaders();
    }

    /**
     * @return null
     */
    protected function buildBody()
    {
        return $this->body;
    }

    /**
     * @return null
     */
    protected function buildQuery()
    {
        return;
    }

    /**
     * @param $body
     */
    private function isValidBody($body)
    {
        if ($body !== null && (!$body instanceof Entity || !$body instanceof Value || !$body instanceof Expression)) {
            throw new \InvalidArgumentException('Only instance of Entity, Value or Expression are accepted as second argument.');
        }
    }
}
