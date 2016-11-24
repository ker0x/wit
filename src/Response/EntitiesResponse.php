<?php
namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class EntitiesResponse extends AbstractResponse
{

    const ID = 'id';
    const NAME = 'name';
    const DOC = 'doc';
    const LANG = 'lang';
    const LOOKUPS = 'lookups';
    const BUILTIN = 'builtin';
    const EXOTIC = 'exotic';
    const DELETED = 'deleted';

    /**
     * @var null|string
     */
    protected $id;

    /**
     * @var null|string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $doc;

    /**
     * @var null|string
     */
    protected $lang;

    /**
     * @var null|array
     */
    protected $lookups;

    /**
     * @var null|bool
     */
    protected $builtin;

    /**
     * @var null|string
     */
    protected $deleted;

    /**
     * EntitiesResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @param array $response
     * @return void
     */
    protected function parseResponse(array $response)
    {
        if (!$this->hasError($response)) {
            $this->setId($response);
            $this->setName($response);
            $this->setDoc($response);
            $this->setLang($response);
            $this->setLookups($response);
            $this->setBuiltin($response);
            $this->setDeleted($response);
        }
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $response
     */
    private function setId(array $response)
    {
        if (isset($response[self::ID])) {
            $this->id = $response[self::ID];
        }
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $response
     */
    private function setName(array $response)
    {
        if (isset($response[self::NAME])) {
            $this->name = $response[self::NAME];
        }
    }

    /**
     * @return null|string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * @param array $response
     */
    private function setDoc(array $response)
    {
        if (isset($response[self::DOC])) {
            $this->doc = $response[self::DOC];
        }
    }

    /**
     * @return null|string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param array $response
     */
    private function setLang(array $response)
    {
        if (isset($response[self::LANG])) {
            $this->lang = $response[self::LANG];
        }
    }

    /**
     * @return array|null
     */
    public function getLookups()
    {
        return $this->lookups;
    }

    /**
     * @param array $response
     */
    private function setLookups(array $response)
    {
        if (isset($response[self::LOOKUPS])) {
            $this->lookups = $response[self::LOOKUPS];
        }
    }

    /**
     * @return bool|null
     */
    public function getBuiltin()
    {
        return $this->builtin;
    }

    /**
     * @param array $response
     */
    private function setBuiltin(array $response)
    {
        if (isset($response[self::BUILTIN])) {
            $this->builtin = $response[self::BUILTIN];
        }
    }

    /**
     * @return null|string
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param array $response
     */
    private function setDeleted(array $response)
    {
        if (isset($response[self::DELETED])) {
            $this->deleted = $response[self::DELETED];
        }
    }
}
