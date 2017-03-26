<?php

    /**
     * Return a instance of auth user.
     */
    function u()
    {
        return Auth()->user ();
    }

    /**
     * @param $n
     * @param int $precision
     *
     * @return string
     *
     * @author https://gist.github.com/RadGH/84edff0cc81e6326029c
     */
    function k($n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'k';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'm';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'b';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format . $suffix;
    }

    /**
     * For builder like query.
     *
     * @param $string
     *
     * @return string
     */
    function l ($string)
    {
        if($string)
            return "%".$string."%";
        return null;
    }


    /**
     * I don`t know regulars.
     * @param $tags
     * @return array
     */
    function validateTags ($tags)
    {
        $tags = explode(',', preg_replace("/[^a-zA-ZА-Яа-я0-9-,]/", "$1", $tags));

        foreach($tags as $key => $value)
        {
            if(!$value && isset($tags[$key])) {
                unset($tags[$key]);
            }
        }
        return implode(',', $tags);
    }

    /**
     * @param int $char
     * @return string
     */
    function jpg_random ($char = 10)
    {
        return str_random($char).'.jpg';
    }

    /**
     * @return string
     */
    function get_upload_path ()
    {
        $carbon = new \Carbon\Carbon();

        $path = $carbon->today()->timestamp;

        $files = get_path($path);

        return "uploads/".$path.'/';
    }

    /**
     * Get upload folder, or create it.
     *
     * @param $p
     * @return FilesystemIterator
     */
    function get_path ($p)
    {
        $path = public_path("/uploads/".$p);

        try {
            new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
        }catch(UnexpectedValueException $e) {
            mkdir($path);
        }

        return new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
    }
