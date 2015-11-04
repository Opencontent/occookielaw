<?php

class OCCookieLaw
{
    protected static $isActive = true;

    protected static function run()
    {
        self::checkIfLoggedIn();

        $ini = eZINI::instance( 'cookielaw.ini' );
        if ( self::$isActive )
        {
            $message = ezpI18n::tr(
                'extension/occookielaw',
                "I cookie ci aiutano ad erogare servizi di qualità. Utilizzando i nostri servizi, l'utente accetta le nostre modalità d'uso dei cookie."
            );
            if ( $ini->hasVariable( 'AlertSettings', 'MessageText' ) )
            {
                $message = $ini->variable( 'AlertSettings', 'MessageText' );
            }

            $dismiss = ezpI18n::tr( 'extension/occookielaw', "OK" );
            if ( $ini->hasVariable( 'AlertSettings', 'DismissButtonText' ) )
            {
                $dismiss = $ini->variable( 'AlertSettings', 'DismissButtonText' );
            }

            $info = ezpI18n::tr( 'extension/occookielaw', "Maggiori informazioni" );
            if ( $ini->hasVariable( 'AlertSettings', 'InfoButtonText' ) )
            {
                $info = $ini->variable( 'AlertSettings', 'InfoButtonText' );
            }

            $tpl = eZTemplate::factory();
            $tpl->setVariable( 'message', $message );
            $tpl->setVariable( 'dismiss_button', $dismiss );
            $tpl->setVariable( 'info_button', $info );

            return $tpl->fetch( 'design:inject_in_page_layout.tpl' );
        }
        return '';
    }

    public static function injectAlert( $templateResult )
    {
        $data = self::run() . '</body>';
        $templateResult = str_replace( '</body>', $data, $templateResult );
        return $templateResult;
    }

    public static function filter( $templateResult )
    {
        if ( class_exists( 'ezpEvent' ) )
            return $templateResult;
        return self::injectAlert( $templateResult );
    }

    protected static function checkIfLoggedIn()
    {
        $ini = eZINI::instance( 'cookielaw.ini' );
        if ( eZUser::currentUser()->isLoggedIn()
             && ( $ini->hasVariable( 'UriExcludeList', 'ExcludeUserLoggedIn' )
                  && $ini->variable( 'UriExcludeList', 'ExcludeUserLoggedIn' ) == 'enabled' ) )
        {
            self::$isActive = false;
        }
    }

    public static function checkIfNeeded( eZURI $uri )
    {
        $original = $uri->uriString();
        $parts = $uri->URIArray;

        $checkUrls = array( $original );
        $countParts = count( $parts );
        for ( $i = 0; $i <= $countParts; $i++ )
        {
            $slice = array_slice( $parts, 0, $i );
            if ( !empty( $slice ) )
            {
                $sliceString = implode( '/', $slice );
                $checkUrls[] = $sliceString . '/*';
            }
        }

        $ini = eZINI::instance( 'cookielaw.ini' );
        if ( $ini->hasVariable( 'UriExcludeList', 'Exclude' ) )
        {
            $excludeList = (array) $ini->variable( 'UriExcludeList', 'Exclude' );
            foreach( $checkUrls as $url )
            {
                if ( in_array( $url, $excludeList ) )
                {
                    self::$isActive = false;
                }
            }
        }
    }

}