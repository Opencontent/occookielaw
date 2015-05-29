# OpenContent CookieLaw

L'estensione inietta automaticamente nel pagelayout il template `occookielaw/design/standard/templates/inject_in_page_layout.tpl` (ricavato da https://www.cookiechoices.org/)
Non serve inserire template a mano, il filtro di output sostituisce il testo `</body>` con il contentuto del template.

## Attivazione

* in `<document_root_mio_sito>/extension` eseguire:
```
git clone ssh://developer@devapache.opencontent.it:222/home/git/occookielaw
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

* eseguire l'override (statico, cioè senza regola in override.ini) del file occookielaw/design/standard/templates/cookie.tpl nella propria estensione


## TODO
* traduzioni dei testi di default in occookielaw/classes/occookielaw.php