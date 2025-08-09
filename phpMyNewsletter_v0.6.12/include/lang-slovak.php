<?





function translate($phrase) {
 global $lang;
 if($lang[$phrase]!="") return $lang[$phrase];
else return ("[** Translation Needed ] -> $phrase");
}



/********* New translation style *******/

$lang=array("Adresse e-mail"=>"E-mailov  adresa",
	    "Inscription"=>"Zap¡sanie sa",
	    "Désinscription"=>"Odhl senie sa",
	    "Nombre d'abonnés"=>"Poet prihl senìch",
	    "Erreur ! Le mot de passe n'est pas valide"=>"Chyba! Zl heslo",
	    "En attente de validation"=>"¬akajte na overenie",
	    "Nbr de NewsLetter déjà envoyées"=>"Poet u§ poslanìch spr v",
	    "Numéro de la prochaine NewsLetter"=>"Poet Ôalç¡ch spr v",
	    "Retour"=> "Sp",
	    "Erreur"=>"Chyba",
	    "Déjà inscrit"=>"Takìto z znam u§ v DB existuje",
	    "Impossible de trouver la base"=>"Nem§em n js DB",
	    "Impossible de trouver le serveur"=>"Nem§em sa spoji s hostiteom",
	    "Erreur lors du flush de la table temp"=>"Chyba poas odstraåovania doasnej tabulky",
	    "Appercu du message"=>"N had spr vy",
	    "Réinitialiser"=>"Reset",
	    "Sujet"=>"Predmet",
	    "Rédiger un nouveau message"=>"Nap¡sa nov£ spr vu",
	    "Tous les champs doivent être remplis"=>"Vçetky polia formul ra musia by vyplnen",
	    "Texte"=>"Text",
	    "Adresse Email non valide"=>"Chybn  e-mailov  adresa",
	    "Administration"=>"Administran  z¢na",
	    "Nouveau message"=>"Nov  spr va",
	    "Liste des abonnés"=>"Zoznam odberateov",
	    "Ajout d'un abonné"=>"Pridaj odberatea",
	    "Suppression d'un abonné"=>"Odstr å odberataa",
	    "Voir l'historique"=>"Prezrie logy",
	    "Pour vous désinscrire, rendez-vous à l'adresse suivante" =>"Pre odhl senie sa, choÔte na tento URL odkaz",

	    "Configuration"=>"Konfigur cia",
	    "Se déconnecter"=>"Log Out",
	    "Configuration de phpMyNewsletter"=>"Konfigur cia phpMyNewsletter",
	    "Editer la configuration"=>"Zmeni konfigur ciu",
	    "Editer les messages de bienvenue ..."=>"Zmeni uv¡taciu spr vu ...",
	    "Mise à jour de la configuration effectuée"=>"Konfigur cia aktualizovan ",
	    "Supprimer des abonnés"=>"Odstr ni odberateov",
	    "Sélectionner les abonnés à supprimer"=>"Ozna odberatea, ktorì sa m  odstr ni",
	    "Supprimer les abonnés sélectionnés"=>"Odstr ni oznaenìch odberateov",
	    "Les abonnés sélectionnés ont été supprimé"=>"Oznaenì odberatelia odstr nenì",
	    "Importer un fichier texte dans la base de donnée"=>"Importuj textovì s£bor do DB",
	    "Importation effectuée"=>"Importovanie hotov",
	    "Logs de phpMyNewsletter"=>"phpMyNewsletter logy",
	    "Heure"=>"Hodina",
	    "Sujet du message de bienvenue"=>"Predmet uv¡tacej spr vy",
	    "Message de bienvenue envoyé après la confirmation de l'abonné"=>"Uv¡tacia spr va poslan  po s£hlase odberatea",
	    "Corps du message de bienvenue"=>"Telo uv¡tacej spr vy",
	    "Pied des messages"=>"Pta spr vy",

	    "Mettre à jour"=>"Aktualizuj",
	    "Réinitialiser"=>"Reset",
	    "Message de demande de confirmation"=>"Potvrdzovacia spr va",
	    "Inscription"=>"Zap¡sanie sa",

	    "Avertir de l'inscription par mail"=>"Informuj odberatea",
	    "Un mail de d'information va être envoyé"=>"Informanì e-mail bol poslanì",
	    "Nombre total d'abonnés"=>"Poet odberateov",
	    "Vous n'avez pas d'abonnés"=>"¦iaden odberate v DB",


	    "Mot de passe"=>"Heslo",
	    "valider"=>"Login",
	    "Identification"=>"Identifik cia",
	    "Accès à l'administration"=>"Administr torskì pr¡stup",

	    "Rendez-vous à l'adresse suivante pour confirmer votre inscription"=>"Jednoducho choÔte na tento odkaz, ak chcete potvrdi zap¡sanie sa",
	    "Si vous n'avez pas demandé d'inscription à cette newsletter, ignorez simplement ce message"=>"Ak ste nepo§adovali zap¡sanie sa, jednoducho t£to spr vu ignorujte",
	    "Confirmation de l'inscription"=>"Potvrdenie zap¡sania sa",


	    "Votre inscription c'est bien déroulée"=>"Zap¡sanie sa hotov",
	    "L'inscription s'est bien déroulée"=>"Zap¡sanie sa hotov",
	    "Vous allez recevoir un mail de confirmation"=>"Potvrdzovac¡ e-mail V m bol poslanì",
	    "Vous êtes déjà inscrit"=>"U§ ste v naçej DB",
	    "Vous n'êtes pas inscrit à cette Newsletter"=>"Eçte nie ste v naçej DB",
	    "Votre inscription a été confirmée"=>"Zap¡sanie sa bolo potvrden",
	    "Désinscription de" =>"Odhl senie sa z",
	    "effectuée, merci de votre visite" =>"hotovo, Ôakujeme za Vaçu n vçtevu",
	    "Si vous désirez vous réinscrire, rendez vous à l'adresse suivante" =>"Ak sa chcete op zap¡sa, jednoducho kliknite sem " ,


	    "Nom de la lettre d'information"=>"Meno oznamu",
	    "Hébergeur" =>"Poskytovate",
	    "autre" =>"Ni Ôalçieho",
	    "Adresse de provenance des messages envoyés" =>"Expedujem adresy (z poa e-mail)",
	    "Nombre de jours accordé pour la validation de l'abonnement"=>"¬akajte na overenie",
	    "jours"=>"dn¡",
	    "Base de données"=>"DataB za",
	    "Serveur mysql"=>"MySQL server",
	    "Nom d'utilisateur"=>"U§. meno",
	    "Mot de passe"=>"Heslo",
	    "Nom de la base de donnée"=>"Meno DB",
	    "Nom de la table de stockage des adresses"=>"Tabuka adries",
	    "Nom de la table d'attente de validation"=>"Tabuka overenia platnosti",
	    "Nom de la table de logs"=>"Tabuka logov",
	    "Nom de la table de config"=>"Tabuka nastaven¡",
	    "Mot de passe d'accès au panneau d'administration"=>"Heslo pre administran£ z¢nu",
	    "Nombre de newsletter à afficher par page de logs"=>"Poet logov na str nku",
	    "Adresse de votre page ex : http://www.myweb.com/ avec un / à la fin" =>"Pr¡klad URL web str nky:  http://www.mojweb.com/ (nazabudnite na posledn / )",
	    "Emplacement du répertoire de phpMyNewsletter ex : tools/newsletter/ avec un / à la fin"=>"Pr¡klad cesty k phpMyNewsletter: tools/newsletter/ (nazabudnite na posledn / )",
	    "Langue"=>"Jazyk",
	    "Activer le processus de validation des inscriptions"=>"Povo overovac¡ proces pri zap¡san¡ sa",
	    "OUI"=>"µNO",
	    "NON"=>"NIE",

	    "Export" => "Export",
	    "Exporter les abonnés" => "Exportuj odberateov",
	    "exporter" => "export",

	    "Collez les lignes suivantes dans le fichier include/config.inc.php" => "Vystrihni & Vlo§ riadky z include/config.inc.php",

	    "Message envoyé"=>"Spr va poslan ",
	    "Lettre d'information N-"=>"Oznam #",
	    "Envoyer le message"=>"Posla spr vu",
	    "Retour"=>"ChoÔ sp");
?>