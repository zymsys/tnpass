<?php
namespace TrueNorth\Password;

class Generator
{
    public function generate($forSite, $unguessable)
    {
        $keyword = $this->getKeyword($forSite);
        $secret = $this->makeSecret($keyword);
        if (!empty($unguessable)) {
            $this->makeUnguessable($secret);
        }
        return $secret;
    }

    private function makeSecret($keyword)
    {
        return str_replace(
            ['i','a','o','s'],
            ['1','@','0','$'],
            $keyword
        );
    }

    private function getKeyword($forSite)
    {
        $parts = explode('://', $forSite);
        $parts = explode('.', array_pop($parts));
        $keyword = array_shift($parts);
        if ($keyword === 'www') {
            $keyword = array_shift($parts);
        }
        return strtolower($keyword);
    }

    private function makeUnguessable(&$secret)
    {
        $secret .= '!';
    }
}