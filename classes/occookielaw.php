<?php

class OCCookieLaw
{
    protected static function run()
    {
        $ini = eZINI::instance( 'cookielaw.ini' );

        $message = ezpI18n::tr( 'extension/occookielaw', "I cookie ci aiutano ad erogare servizi di qualità. Utilizzando i nostri servizi, l'utente accetta le nostre modalità d'uso dei cookie." );
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

    public static function injectAlert( $templateResult )
    {
        $data = self::run();
        $templateResult = str_replace( '</body>', $data, $templateResult );
        return $templateResult;
    }


}