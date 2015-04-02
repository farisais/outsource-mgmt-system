lížeče Chrome s tímto účtemChcete propojit údaje prohlížeče Chrome s tímto účtem?Přihlašujete se pomocí spravovaného účtu a poskytujete jeho správci kontrolu nad vaším profilem Google Chrome. Vaše údaje prohlížeče Chrome, například aplikace, záložky, historie, hesla a jiná nastavení, budou trvale přidružena k účtu $1. Tyto údaje budete moci smazat pomocí služby Dashboard, ale nebudete je moci přidružit k jinému účtu. $2Přihlašujete se pomocí spravovaného účtu a poskytujete jeho správci kontrolu nad vaším profilem Google Chrome. Vaše údaje prohlížeče Chrome, například aplikace, záložky, historie, hesla a jiná nastavení, budou trvale přidružena k účtu $1. Tyto údaje budete moci smazat pomocí stránky Dashboard služby Účty Google, ale nebudete je moci přidružit k jinému účtu. Pokud chcete uchovat existující údaje Chrome odděleně, můžete vytvořit nový profil. $2Ukládat údaje do prohlížeče ChromePřejděte do
        nabídky Chrome >
        <span jscontent="settingsTitle"></span>
        >
        <span jscontent="advancedTitle"></span>
        a zrušte výběr možnosti <span jscontent="noNetworkPredictionTitle"></span>.
        Pokud to však problém nevyřeší, doporučujeme vám 
        tuto možnost znovu vybrat (pro zlepšení výkonu).V nastavení firewallu a antivirového programu povolte prohlížeči Chrome
        přístup k síti.Přejděte do
          nabídky Chrome >
          <span jscontent="settingsTitle"></span>
          >
          <span jscontent="advancedTitle"></span>
          >
          <span jscontent="proxyTitle"></span>
          >
          Nastavení místní sítě (LAN)
          a zrušte zaškrtnutí políčka Použít pro síť LAN server proxy.Spouštěč aplikací ChromeSpouštěč aplikací Chrome CanaryPřihlášení do ChromeChcete-li používat aplikace, musíte být do Chromu přihlášeni. To Chromu umožňuje synchronizovat vaše aplikace, záložky, historii, hesla a další nastavení mezi zařízeními.Aplikace ChromeAplikace Chrome CanarySoftware spuštěný v počítači není kompatibilní s prohlížečem Google Chrome.Centrum oznámení ChromeZde se zobrazují všechna oznámení z aplikací, rozšíření a webů Chrome.IDD_CHROME_FRAME_FIND_DIALOG DIALOGEX 0, 0, 278, 60
STYLE DS_SETFONT | DS_MODALFRAME | DS_FIXEDSYS | WS_POPUP | WS_VISIBLE | WS_CAPTION | WS_SYSMENU
EXSTYLE WS_EX_CONTROLPARENT
CAPTION "Find"
FONT 8, "MS Shell Dlg", 400, 0, 0x1
BEGIN
    EDITTEXT        IDC_FIND_TEXT,51,7,154,14,ES_AUTOHSCROLL
    DEFPUSHBUTTON   "&Find Next",IDOK,221,7,50,14
    PUSHBUTTON      "Cancel",IDCANCEL,221,24,50,14
    CONTROL         "Match &case",IDC_MATCH_CASE,"Button",BS_AUTOCHECKBOX | WS_TABSTOP,6,24,52,10
    GROUPBOX        "Direction",IDC_STATIC,85,24,119,24
    CONTROL         "&Down",IDC_DIRECTION_DOWN,"Button",BS_AUTORADIOBUTTON | WS_GROUP | WS_TABSTOP,101,34,34,10
    CONTROL         "&Up",IDC_DIRECTION_UP,"Button",BS_AUTORADIOBUTTON,155,34,38,10
    LTEXT           "Fi&nd what:",IDC_STATIC,6,7,35,8
ENDIDD_CHROME_FRAME_READY_PROMPT DIALOGEX 0, 0, 393, 14
STYLE DS_SETFONT | DS_FIXEDSYS | WS_CHILD
FONT 8, "MS Shell Dlg", 400, 0, 0x0
BEGIN
    LTEXT           "This site recommends Google Chrome Frame (already installed).",IDC_PROMPT_MESSAGE,16,3,207,8
    LTEXT           "Learn more.",IDC_PROMPT_LINK,233,3,42,8
    ICON            IDI_CHROME_FRAME_ICON,IDC_PROMPT_ICON,3,2,23,17,0,WS_EX_TRANSPARENT
    DEFPUSHBUTTON   "Enable",IDACTIVATE,280,2,50,12
    PUSHBUTTON      "Ignore",IDNEVER,340,2,50,12
ENDIDD_CHROME_FRAME_TURNDOWN_PROMPT DIALOGEX 0, 0, 393, 14
STYLE DS_SETFONT | DS_FIXEDSYS | WS_CHILD
FONT 8, "MS Shell Dlg", 400, 0, 0x0
BEGIN
    LTEXT           "This site is using the Chrome Frame plug-in which will soon be unsupported. Please uninstall it and upgrade to a modern browser.",IDC_TD_PROMPT_MESSAGE,3,3,414,8
    LTEXT           "Learn more.",IDC_TD_PROMPT_LINK,238,3,42,8
    PUSHBUTTON      "Uninstall",IDUNINSTALL,285,2,50,12
    DEFPUSHBUTTON   "Dismiss",IDDISMISS,340,2,50,12
ENDLišta záložekChcete-li mít své záložky vždy po ruce, umístěte je sem na lištu záložek.Importovat záložky...Importováno z aplikace IEImportováno z FirefoxuImportováno z prohlížeče SafariImportováno z lišty Google ToolbarImportovanéMobilní záložkyOstatní záložkyZobrazit zástupce aplikaceAplikaceZobrazit aplikace&Otevřít všechny záložkyOtevřít všechny záložky v &novém okněOtevřít všechny záložky v &anonymním okně&Otevřít v nové kartěOtevřít v &novém okněOtevřít v &anonymním okně&Upravit...&Přejmenovat...&SmazatPřidat strá&nku...Přidat &složku...&Zobrazit lištu záložekUrčitě chcete otevřít $1 karty (karet)?Záložka byla přidána.ZáložkaJméno:Složka:OdstranitUpravit...Vybrat jinou složku...Jméno:Jméno:Adresa URL:Nová složkaNová složkaUpravit záložkuTato složka obsahuje záložky ($1). Opravdu ji chcete smazat?Nová složkaUpravit název složkyNová složkaPřidat do záložek všechny kartyLíbí se vám tento web? Kliknutím sem jej můžete přidat do záložek.OdmítnoutSprávce záložekHledat v záložkách&Správce záložekUspořádatZobrazit ve složceSeřadit podle abecedyImportovat záložky ze souboru HTML...Exportovat záložky do souboru HTML...JménoAdresa URLNeplatná adresa URL.PosledníVyhledávánízáložky_$1.html&ZáložkyPřidat tuto stránku do záložek...Přidat do záložek otevřené stránky...Přidat stránku do záložekUpravit záložku pro tuto stránkuByla přidána nová aplikace na pozadíAplikace $1 se spustí při zapnutí systému a poběží na pozadí i v případě, že zavřete všechna okna prohlížeče $2.Aplikace $1 selhala. Klinutím na tuto bublinu aplikaci restartujete.Rozšíření $1 selhalo. Kliknutím na tuto bublinu rozšíření obnovíte.Na pozadí nejsou spuštěny žádné aplikaceNové nastavení oprávnění webových stránek se projeví po opětovném načtení stránky.Načíst znovuPovoleno zásadouBlokováno zásadouPovoleno rozšířenímBlokováno rozšířenímPovoleno vámiBlokováno vámiPovoleno ve výchozím nastaveníBlokováno ve výchozím nastaveníZeptat se ve výchozím nastaveníOprávněníSoubory cookie a data webupovolitblokovatzeptat seObrázkyJavaScriptVyskakovací oknaPluginyPolohaOznámeníCelá obrazovkaUzamčení myšiMédiaZobrazit soubory cookie a data webůSpojeníOprávněníIdentita ověřenaIdentita není ověřenaOstatní$1 (povoleno: $2 / blokováno: $3)Použít výchozí globální hodnotu (Povolit)Použít výchozí globální hodnotu (Blokovat)Použít výchozí globální hodnotu (Dotázat se)Povolit vždy na tomto webuBlokovat vždy na tomto webuPoužít výchozí globální hodnotu ($1)$1:Zobrazit celou historiiChtěli jste přejít na $1?HistorieStažené souboryBez názvuNačítání...Odstranit vybrané položkyPovolit položkyBlokovat položkyVymazat údaje o prohlížení...OdstranitOpravdu chcete tyto stránky vymazat z historie?

Pssst! Příště by se vám mohl hodit anonymní režim ($1).Načítání...$1 - $2$1 – $2Nebyly nalezeny žádné výsledky vyhledávání.Nebyly nalezeny žádné historické záznamy.Hledat v historiiNejnovějšíNovějšíStaršíVýsledky vyhledávání pro výraz $1Historie(pokračování)AkceOdstranit z historieVíce z tohoto webuSeskupit doményZobrazitVšeTýdenMěsícDnesDalšíPředchozí($1)PovolenoZablokovánoV balíčku obsahuOdemknoutUzamknoutByl zablokován pokus <a target="_top" href="$1" id="$2"> navštívit stránku v doméně $3</a>.Zobrazuje se historie všech přihlášených zařízení. <a href="http://support.google.com/chrome/bin/answer.py?answer=95589"&hl=cs">Další informace</a>Zobrazuje se historie z tohoto zařízení. <a href="http://support.google.com/chrome/bin/answer.py?answer=95589"&hl=cs">Další informace</a>Neznámé zařízeníOKZrušitPřidatVrátit smazání&UpravitDalší informaceZavřítHotovoPřeskočitKartaUložit&Zpět&VpředUložit &jako...&Tisk...&Zobrazit zdrojový kód stránkyOtevřít odkaz pomocí...Konfigurovat...Zobrazit &informace o stránkáchZkontrol