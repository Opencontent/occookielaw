<script src="{'javascript/cookiechoices.js'|ezdesign(no)}"></script>
<style>#cookieChoiceInfo{ldelim}position:fixed;width:100%;background-color:#666;color: #fff;font-weight: bold; margin:0; left:0; padding:11px;z-index:1000;text-align:center; {$position}:0;{rdelim}</style>

{literal}
<script>
    document.addEventListener('DOMContentLoaded', function(event) {
        cookieChoices.showCookieConsentBar(
                "I cookie ci aiutano ad erogare servizi di qualità. Utilizzando i nostri servizi, l'utente accetta le nostre modalità d'uso dei cookie.",
                'OK',
                'Maggiori informazioni',
                '{/literal}{'cookie'|ezurl(no,full)}{literal}'
        );});
</script>
{/literal}
