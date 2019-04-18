<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 4/18/19
 * Time: 8:20 AM
 */

if ( !function_exists( 'asset_cache_buster' ) ) {
    /**
     * @param               $path
     * @param bool|false $externalFile
     *
     * @return bool|int|string
     */
    function asset_cache_buster( $path, $externalFile = false )
    {
        $cacheBuster = false;
        if ( $externalFile ) {
            //Only add a new cache buster every hour
//            $cacheBuster = date( 'YmdH' );
//            //If it's not stage or prod
//            if ( !stage_or_prod() ) {
                //allow every second cache buster
                $cacheBuster = date( 'YmdHis' );
//            }

            return $cacheBuster;
        }
        if ( file_exists( $path ) ) {
            //Only calculate sha1 for files types we support
            if ( in_array( pathinfo( $path, PATHINFO_EXTENSION ), config( 'assets.file_sha1_hash', [ 'css', ] ) ) ) {
                $cacheBuster = @sha1_file( $path );
            }
            //If the sha1 fails or the extension isn't supported, use the last modified date
            if ( $cacheBuster === false ) {
                $cacheBuster = filemtime( $path );
            }
        }

        return $cacheBuster;
    }
}

if ( !function_exists( 'external_asset' ) ) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string $path
     * @param  bool $secure
     *
     * @return string
     */
    function external_asset( $path, $secure = null )
    {
        $cacheBuster = asset_cache_buster( $path, true );
        $url = asset( $path, $secure );

        if ( $cacheBuster ) {
            $url = add_param( $url, 'd', $cacheBuster );
        }

        return $url;
    }
}

if ( !function_exists( 'public_asset' ) ) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string $path
     * @param  bool $secure
     *
     * @return string
     */
    function public_asset( $path, $secure = null )
    {
        $cacheBuster = asset_cache_buster( base_path( 'public/' . ( $path ? ltrim( $path, '/' ) : '' ) ) );
        $url = asset( $path, $secure );

        if ( $cacheBuster ) {
            $url = add_param( $url, 'd', $cacheBuster );
        }

        return $url;
    }
}

if ( !function_exists( 'add_param' ) ) {
    /**
     * @param $url
     * @param $key
     * @param $value
     *
     * @return string
     */
    function add_param( $url, $key, $value )
    {
        $query = [];
        $parts = parse_url( $url );

        if ( isset( $parts[ 'query' ] ) ) {
            parse_str( $parts[ 'query' ], $query );
        }

        $query[ $key ] = $value;
        $query = http_build_query( $query );

        if ( !isset ( $parts[ 'query' ] ) ) {
            return $url . '?' . $query;
        }

        return preg_replace( '@\?.+@i', '?' . $query, $url );
    }
}
