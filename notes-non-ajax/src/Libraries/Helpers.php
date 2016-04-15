<?php
namespace Pagekit\Notes\Libraries;

class Helpers
{
    /**
     * get short description from text
     *
     * @param string $content
     * @param int $length
     * @return string
     */
    public function getShort ($content, $length = 200)
    {
        if (strlen($content) > $length)
        {
            $str = strip_tags($content);
            $str = substr($str, 0, $length);
            $str = rtrim($str, "!,.-");
            $str = substr($str, 0, strrpos($str, ' '));
            return $str;
        }
        else
        {
            return $content;
        }
    }

    /**
     * build a pagination
     *
     * @param int $page first page
     * @param int $current current page
     * @param int $total number of all pages
     * @return object
     */
    public function getPagination($page, $current, $total)
    {
        $result = [];
        $result['first'] = (int) $page;
        $result['current'] = (int) $current;
        $result['last'] = (int) $total;

        if ($current == $page && $current == $total)
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        elseif ($current == $page && $current < $total)
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = $current + 1;
        }
        elseif ($current > $page && $current < $total)
        {
            $result['centerFirst'] = $current - 1;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = $current + 1;
        }
        elseif ($current > $page && $current == $total)
        {
            $result['centerFirst'] = $current - 1;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        else
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        return $result;
    }
}