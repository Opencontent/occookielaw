# OpenContent CookieLaw

L'estensione inietta automaticamente nel pagelayout il template `occookielaw/design/standard/templates/inject_in_page_layout.tpl` (ricavato da https://www.cookiechoices.org/)

Non serve inserire template a mano, il filtro di output sostituisce il testo `</body>` con il contenuto del template.

Il contenuto della pagina 'Maggiori informazioni' è statico in `occookielaw/design/standard/templates/cookie.tpl` e viene genrato dal modulo "cookie" considerando le variabili:

* string $site_url = site.ini[SiteSettings]SiteName ( site.ini[SiteSettings]SiteUrl )
* string $info_mail = site.ini[SiteSettings]PrivacyEmail se non c'è notification.ini[SiteSettings]EmailSender se non c'è site.ini[SiteSettings]AdminEmail



## Attivazione

* in `<document_root_mio_sito>/extension` eseguire:
```
git clone https://github.com/Opencontent/occookielaw.git
```

* attivare estensione da backend (o da site.ini rigenerando poi gli autoload)

* svuotare cache ini e cache template

## Personalizzazioni

* in cookielaw.ini

```
[AlertSettings]
MessageText=
DismissButtonText=
InfoButtonText
```

* eseguire l'override (statico, cioè senza regola in override.ini) del file `occookielaw/design/standard/templates/cookie.tpl` nella propria estensione


## TODO
* traduzioni dei testi di default in occookielaw/classes/occookielaw.php
