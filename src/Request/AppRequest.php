<?php

namespace Kerox\Wit\Request;

use Kerox\Wit\Helper\UtilityTrait;

class AppRequest extends AbstractRequest
{

    use UtilityTrait;

    /**
     * @var null|string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $lang;

    /**
     * @var null|string
     */
    protected $private;

    /**
     * @var null|string
     */
    protected $description;

    /**
     * @var null|string
     */
    protected $timezone;

    /**
     * AppRequest constructor.
     *
     * @param string $accessToken
     * @param null|string $name
     * @param null|string $lang
     * @param null|bool $private
     * @param null|string $description
     * @param null|string $timezone
     */
    public function __construct(string $accessToken, $name, $lang, $private, $description, $timezone = null)
    {
        parent::__construct($accessToken);

        $this->name = $name;
        $this->lang = $lang;
        $this->private = $this->boolAsString($private);
        $this->description = $description;
        $this->timezone = $timezone;
    }

    /**
     * @return array
     */
    protected function buildHeaders(): array
    {
        return parent::buildHeaders();
    }

    /**
     * @return array
     */
    protected function buildBody(): array
    {
        $body = [
            'name' => $this->name,
            'lang' => $this->lang,
            'private' => $this->private,
            'timezone' => $this->timezone,
            'desc' => $this->description,
        ];

        return array_filter($body);
    }

    /**
     * @return null
     */
    protected function buildQuery()
    {
        return;
    }
}
