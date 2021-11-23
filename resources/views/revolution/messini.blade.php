@extends('layouts.app_1821')

@section('banner')
    <section id="banner">
        <div class="inner split">
            <section>
                <h2><img src="{{ asset("pubimg/pubimg") }}/{{ $town->logo }}" style="float: left; padding-right:5px;"/> Η Μεσσήνη στην επανάσταση του 1821</h2><br/>

            </section>
            <section>
                <p>Γριφομπότ! Πιστοποιημένο εκπαιδευτικό παιχνίδι γνώσεων<br/>
                   Το παρόν αποτελεί έκδοση για τη συμβολή της Μεσσήνης στην επανάσταση του 1821.</p>
                <ul class="actions">
                    <li><a href="{{ route('plan_init', ['town' => $town->id]) }}" class="button special">ΠΑΜΕ ΣΤΟ ΠΑΙΧΝΙΔΙ!</a></li>
                </ul>
            </section>
        </div>
    </section>
@endsection

@section('town')
    {{ $town->title }}
@endsection

@section('content')
    <section id="one" class="wrapper">
        <div class="inner split">
            <section class="one">
                <h2>Η Μεσσήνη την περίοδο των Ορλωφικών</h2>
                <p>Το 1770 οι Έλληνες με τη βοήθεια των Ρώσων αδερφών Ορλώφ και στρατιωτικών δυνάμεων από τη Ρωσία επαναστάτησαν ενάντια στους Τούρκους. Ανάμεσα στους επαναστάτες ήταν και κάτοικοι της Μεσσήνης. Οι Τούρκοι έστειλαν στη Μεσσηνία, με μεγάλο στρατό Τουρκαλβανών, τον Χατζή Οσμάν Μπέη για να καταπνίξει την επανάσταση. Στη Μεσσήνη και στην ευρύτερη περιοχή έγινε μια προσπάθεια από τον Ιωάννη Μαυρομιχάλη ή Σκυλογιάννη να αντιμετωπιστούν τα στρατεύματα του Χατζή Οσμάν Μπέη. Ο Ιωάννης Μαυρομιχάλης με 400 παλικάρια έκλεισε το πέρασμα στον Ριζόμυλο, που απέχει λίγα χιλιόμετρα από τη Μεσσήνη. Η μάχη με τους 5.000 Τουρκαλβανούς ήταν άνιση, με αποτέλεσμα να σκοτωθούν οι περισσότεροι Έλληνες. Ο Ιωάννης Μαυρομιχάλης υποχώρησε στη Μεσσήνη που τότε την έλεγαν Νησί και με 24 παλικάρια του κλείστηκε στον Μελίπυργο, ένα κτίριο που έμοιαζε με πύργο και βρισκόταν εκεί που σήμερα είναι η Πανηγυρίστρα. Τρεις μέρες πολεμούσαν αδιάκοπα και ο Μελίπυργος δεν έπεφτε. Οι Τουρκαλβανοί μπόρεσαν τελικά να βάλουν φωτιά στο κτίριο αναγκάζοντας τον Ιωάννη Μαυρομιχάλη με τα παλικάρια του να κάνουν ηρωική έξοδο, με τα σπαθιά στα χέρια, για να διασπάσουν τις γραμμές του εχθρού. Σκοτώθηκαν όλοι και μόνο ο Ιωάννης Μαυρομιχάλης με τον μικρό του γιο Πέτρο πιάστηκαν αιχμάλωτοι, βαριά τραυματισμένοι. Εκεί σκοτώθηκε και ο παππούς του Παπαφλέσσα, Γεώργιος Φλέσσας. Στη συνέχεια, τα στρατεύματα του Χατζή Οσμάν Μπέη έβαλαν φωτιά στα σπίτια της Μεσσήνης αφού πρώτα τα λεηλάτησαν.</p>
            </section>
            <section class="two">
                <img src="{{ asset('1821/images/m1.jpg') }}" width="100%">
            </section>
        </div>
    </section>


    <section id="one" class="wrapper">
        <div class="inner split">

            <section>
                <img src="{{ asset('1821/images/m3.jpg') }}" width="100%">
            </section>
            <section>
                <h2>Η Φιλική Εταιρεία στη Μεσσήνη</h2>
                <p>Για την καλύτερη προετοιμασία της επανάστασης των Ελλήνων ενάντια στον τουρκικό ζυγό δημιουργήθηκε στην Οδησσό, το 1814, η Φιλική Εταιρεία από τον Εμμανουήλ Ξάνθο, τον Νικόλαο Σκουφά και τον Αθανάσιο Τσακάλωφ. Η Φιλική Εταιρεία εξαπλώθηκε παντού. Στη Μεσσήνη μυήθηκαν στη Φιλική Εταιρεία μέλη των μεγάλων οικογενειών Καλαμαριώτη και Δαρειώτη. Από την οικογένεια Καλαμαριώτη μυήθηκαν τα αδέρφια Δημήτριος και Κωνσταντίνος. Από την οικογένεια Δαρειώτη μυήθηκαν τα αδέρφια Γεώργιος, Εμμανουήλ και Παναγιώτης. Επίσης στη Φιλική Εταιρεία μυήθηκε ο πρόκριτος Ιωάννης Μιχαλόπουλος, ο πρόκριτος Ιωάννης Πατρίκης, ο έμπορος Αναγνώστης Ποτηρόπουλος, ο πρόκριτος Διαμαντής Χαΐνης, ο Γεώργιος Χρονόπουλος και άλλοι. Αυτοί προετοίμασαν την επανάσταση στη Μεσσήνη και στην ευρύτερη περιοχή.</p>

            </section>

        </div>
    </section>


    <section id="one" class="wrapper">
        <div class="inner split">
            <section>
                <h2>Η απελευθέρωση της Μεσσήνης και η συμμετοχή των κατοίκων στην απελευθέρωση</h2>
                <p>Η απελευθέρωση της Μεσσήνης από τον τουρκικό ζυγό πραγματοποιήθηκε την ίδια μέρα με την απελευθέρωση της Καλαμάτας, δηλαδή την 23η Μαρτίου 1821. Οι κάτοικοι της Μεσσήνης ήταν προετοιμασμένοι γι΄ αυτόν τον ξεσηκωμό από τους μυημένους στη Φιλική Εταιρεία. Αυτός είναι και ο λόγος που σχημάτισαν άμεσα τα πρώτα στρατιωτικά σώματα χωρίς εμπόδια και προβλήματα. Την πρώτη κιόλας μέρα της απελευθέρωσης της Μεσσήνης ο Παπαφλέσσας όρισε διοικητές στη Μεσσήνη τον Δημήτριο Καλαμαριώτη και τον Γεώργιο Δαρειώτη με μεγάλες εξουσίες και στα στρατιωτικά σώματα επαναστατών που συγκροτούνταν. Στις 24 Μαρτίου 1821, οι κάτοικοι της Μεσσήνης και των γύρω περιοχών, συγκεντρώθηκαν σε περιοχή κοντά στον Πάμισο ποταμό και πραγματοποίησαν δοξολογία. Το πρώτο στρατιωτικό σώμα αποτελούμενο από 250 άνδρες, με επικεφαλής τον Γεώργιο Δαρειώτη, ξεκίνησε εκείνη την ημέρα για να συμμετάσχει στην πολιορκία και κατάληψη των κάστρων της Πυλίας που βρισκόντουσαν στα χέρια των Τούρκων. Το ίδιο έκαναν και τα αδέρφια Δημήτριος και Κωνσταντίνος Καλαμαριώτης που διέθεσαν μεγάλα χρηματικά ποσά για τον Αγώνα και ταυτόχρονα με δικά τους χρήματα συντηρούσαν ένοπλα τμήματα. Μικρά στρατιωτικά σώματα είχαν συγκροτήσει ο Ιωάννης Πατρίκης και ο Μιχάλης Ζαλμάς.</p>
            </section>
            <section>
                <img src="{{ asset('1821/images/m2.jpg') }}" width="100%">
            </section>
        </div>
    </section>


    <section id="one" class="wrapper">
        <div class="inner split">
            <section>
                <img src="{{ asset('1821/images/m4.png') }}" width="100%">
            </section>
            <section>
                <h2>Ο Ιμπραήμ καταστρέφει τη Μεσσήνη</h2>
                <p>Μετά τη μάχη του Μανιακίου, στις 20 Μαΐου 1825, και τον ηρωικό θάνατο του Παπαφλέσσα και των παλικαριών του, οι δυνάμεις του Ιμπραήμ ανενόχλητες εισήλθαν στον μεσσηνιακό κάμπο λεηλατώντας και καίγοντας τα πάντα στο πέρασμά τους. Έκαψαν τα χωριά Άρη, Ασπροπουλιά, Βρωμόβρυση, Σπιτάλι, Καρτερόλι και Μαυρομάτι και μπήκαν στη Μεσσήνη. Λεηλάτησαν τη Μεσσήνη και έβαλαν φωτιά στα σπίτια. Συνέλαβαν όσους κατοίκους δεν πρόφτασαν να εγκαταλείψουν τη Μεσσήνη και να κρυφτούν στα βουνά. Κάποιους τους σκότωσαν και τους υπόλοιπους, ιδιαίτερα τους νεότερους σε ηλικία, τους μετέφεραν στην Αίγυπτο και τους πούλησαν στα σκλαβοπάζαρα. Ο Ιμπραήμ, για να τρομοκρατήσει τους κατοίκους και να τους αναγκάσει να τον προσκυνήσουν, έστησε μόνιμη κρεμάλα στη Μεσσήνη. Μετά την καταστροφή της Μεσσήνης, εισήλθε χωρίς να βρει αντίσταση στην Καλαμάτα στην οποία προξένησε λεηλασίες και καταστροφές. Συμπλοκές σημειώθηκαν μόνο στα μοναστήρια του Προφήτη Ηλία και της Βελανιδιάς. Μετά την κατάληψη της Καλαμάτας ο Ιμπραήμ με τα στρατεύματά του επέστρεψε και πάλι στη Μεσσήνη για να αποτελειώσει το καταστροφικό του έργο.</p>
            </section>

        </div>
    </section>


    <section id="one" class="wrapper">
        <div class="inner split">

            <section>
                <h2>Ο επίσκοπος Ανδρούσης και η προσφορά του στην επανάσταση του 1821</h2>
                <p>Μια μεγάλη προσωπικότητα με τεράστια προσφορά στον απελευθερωτικό Αγώνα των Ελλήνων ήταν και ο επίσκοπος Ιωσήφ. Είχε γεννηθεί στην Αρκαδία. Διατέλεσε επίσκοπος Ανδρούσης την περίοδο 1806 - 1833 και επίσκοπος Μεσσήνης την περίοδο 1833 - 1844.
                </p>
                <p>Λίγο πριν από την επανάσταση των Ελλήνων την 23η Μαρτίου 1821, οι Τούρκοι πληροφορήθηκαν ότι οι Έλληνες κάτι ετοίμαζαν, γι΄ αυτό διέταξαν να πάνε στην Τρίπολη όλοι οι Αρχιερείς και οι Πρόκριτοι. Ο επίσκοπος Ιωσήφ, αν και ήξερε ότι πηγαίνοντας στην Τρίπολη οι Τούρκοι θα τον φυλάκιζαν και θα τον βασάνιζαν, αποφάσισε να ανταποκριθεί για να πειστούν οι Τούρκοι ότι δεν ετοίμαζαν κάτι οι Έλληνες. Εκτός από τον Ιωσήφ Ανδρούσης ανταποκρίθηκαν και οκτώ ακόμη Αρχιερείς: ο Χρύσανθος Παγώνης, Μητροπολίτης Μονεμβασιάς και Καλαμάτας, ο Γερμανός Ζαφειρόπουλος, Μητροπολίτης Χριστιανούπολης, ο Φιλάρετος, Μητροπολίτης Ωλένης, ο Δανιήλ Παπαγιαννόπουλος, Μητροπολίτης Τριπολιτσάς και Αμυκλών, ο Κύριλλος Ροδόπουλος, Μητροπολίτης Κορίνθου, ο Γρηγόριος Καλαμαράς, Μητροπολίτης Ναυπλίας και Άργους και ο Φιλόθεος Χατζής, Μητροπολίτης Δημητσάνας.</p>
                <p>
                    Οι Τούρκοι, όσους πήγαν στην Τρίπολη, τους φυλάκισαν και τους βασάνισαν. Τους είχαν δέσει με χοντρές αλυσίδες μέσα σε ένα μπουντρούμι. Οι πέντε Αρχιερείς από τα βασανιστήρια και τις κακουχίες δεν άντεξαν και πέθαναν. Τους τρεις που επέζησαν, μεταξύ των οποίων και ο Ιωσήφ Ανδρούσης, τους ελευθέρωσαν τα παλικάρια του Κολοκοτρώνη όταν εισήλθαν νικητές στην Τρίπολη.</p>
                <p>
                    Μετά την απελευθέρωσή του, ο Ιωσήφ Ανδρούσης, ξεκίνησε κι αυτός τον αγώνα του για την αποτίναξη του τουρκικού ζυγού. Συγκέντρωσε από τις εκκλησίες και τα μοναστήρια τα χρυσά και αργυρά σκεύη καθώς και ό,τι χρήματα διέθεταν και τα έδωσε για να καλυφθούν οι ανάγκες σε τρόφιμα και πολεμοφόδια των στρατιωτικών σωμάτων που πολεμούσαν τους Τούρκους. Το 1822 έγινε υπουργός Θρησκείας και λίγο αργότερα και υπουργός Δικαιοσύνης. Ο Ιμπραήμ επειδή δεν μπόρεσε να τον συλλάβει όταν κατέλαβε τη Μεσσηνία τον επικήρυξε με χρηματικό ποσό. Ο Ιωσήφ Ανδρούσης διέφυγε στη Μονή Αγίων Αναργύρων Ερμιόνης. Πέθανε το 1843 και η ταφή του έγινε στη Μεσσήνη στον Ιερό Ναό του Αγίου Ιωάννη.</p>

            </section>
            <section>
                <img src="http://1821.grifobot.gr/pubimg/pubimg/fileName_6019b98fc6fc1_1612298639.png" width="100%">
            </section>
        </div>
    </section>

    <section id="one" class="wrapper">
        <div class="inner split">

            <section>
                <img src="{{asset('1821/images/papatsonis.jpg')}}" width="100%">
            </section>
            <section>
                <h2>Προσωπικότητες του αγώνα - Δημήτρης Παπατσώνης (1798 - 1825)</h2>
                <p>Ένας από τους επισημότερους στρατιωτικούς της επανάστασης του 1821 ήταν και ο Δημήτρης Παπατσώνης που είχε γεννηθεί στο χωριό Ναζήρι (Εύα) του σημερινού δήμου Μεσσήνης. Πολέμησε στο Βαλτέτσι, στην πολιορκία της Τρίπολης, στα Δερβενάκια και σε πολλές ακόμη μάχες. Έγινε μέλος της Πελοποννησιακής Γερουσίας. Το 1824 φυλακίστηκε μαζί με το Θεόδωρο Κολοκοτρώνη στην Ύδρα γιατί θεωρήθηκε εχθρός της κυβέρνησης Κουντουριώτη. Μετά την απελευθέρωσή του συνέχισε τον στρατιωτικό του αγώνα. Σκοτώθηκε στα Τρίκορφα, στις 24 Ιουνίου 1825,  πολεμώντας τα στρατεύματα του Ιμπραήμ.
                </p>
            </section>
        </div>
    </section>

    <section id="one" class="wrapper">
        <div class="inner split">

            <section>
                <h2>Προσωπικότητες του αγώνα - Ηλίας Κορμάς (1780 - 1825)</h2>
                <p>Ο Ηλίας Κορμάς γεννήθηκε στο χωριό Κεφαλινού, του σημερινού δήμου Μεσσήνης. Μυήθηκε στη Φιλική Εταιρεία από τον Παπαφλέσσα και έλαβε μέρος στην επανάσταση του 1821. Πολέμησε στην πολιορκία της Μεθώνης, στο Βαλτέτσι, στην πολιορκία της Τρίπολης, στο Άργος, στα Δερβενάκια και σε πολλές ακόμη μάχες. Στη μάχη της Πιάνας διακρίθηκε και έγινε υπασπιστής του Θεόδωρου Κολοκοτρώνη. Το 1824 προήχθη στο βαθμό του Χιλίαρχου και το 1825 προήχθη σε Αντιστράτηγο. Ακολούθησε τον Παπαφλέσσα στο Μανιάκι και σκοτώθηκε εκεί πολεμώντας τα στρατεύματα του Ιμπραήμ.
                </p>
                <p>
                    Σύμφωνα με τον ιστορικό Φωτάκο ο Ηλίας Κορμάς έλαβε μέρος στη μάχη του Μανιακίου μαζί με 120 παλικάρια από το χωριό του και τα γύρω χωριά μεγάλος αριθμός των οποίων ήταν και συγγενείς του. Μάλιστα δίπλα του, στο ίδιο ταμπούρι, σκοτώθηκαν οι: Γεωρ. Κορμάς, Κων. Κορμάς, Νικ. Κορμάς, Παν. Πανούσης, Κων. Σκρεπετός, Φωτεινός Σκρεπετός, Δημ. Τσεκούρας, Βασ. Τσεκούρας.
                </p>
                <p>
                    <em>
                    «Η Λιου η καπετάνισσα αργά το μεσονύχτι<br/>
                    στο παρεθύρι κάθεται, στους δρόμους αγναντεύει.<br/>
                    Βλέπει στρατιώτες να ΄ρχονται, διαβάτες να περνάνε.<br/>
                    -Στρατιώτες μου, διαβάτες μου, καλά μου παλικάρια<br/>
                    Μην είδατε το Λια Κορμά, το Λια τον καπετάνιο;<br/>
                    -Κει στο Μανιάκι κείτονται όλοι οι καπετανέοι,<br/>
                    Ο Παπαφλέσσας, κι ο Κορμάς και ο Μαυρομιχάλης,<br/>
                    Μπιτσάνης από την Ποιλιανή μαζί με τον Κεφάλα,<br/>
                    Στρώμα έχουνε τη μαύρη γη, προσκέφαλο μια πέτρα<br/>
                    και από πάνω σκέπασμα του φεγγαριού τη λάμψη»<br/>
                    </em>
                </p>
            </section>

            <section>
                <img src="{{asset('1821/images/kormas.jpg')}}" width="100%">
            </section>
        </div>
    </section>
    <section id="one" class="wrapper">
        <div class="inner split">

            <section>
                <img src="{{asset('1821/images/kkormas.jpg')}}" width="100%">
            </section>
            <section>
                <h2>Προσωπικότητες του αγώνα - Κωνσταντίνος Κορμάς (1783 - 1825)</h2>
                <p>Ο Κωνσταντίνος Κορμάς γεννήθηκε την περίοδο της τουρκοκρατίας στο χωριό Κεφαλινού και ήταν αδερφός του Χιλίαρχου Ηλία Κορμά.  Έλαβε μέρος, όπως και όλη του η οικογένειας, στην επανάσταση του 1821. Πολέμησε στην πολιορκία της Τρίπολης, στο Άργος, στα Δερβενάκια και στα Τρίκορφα. Ακολούθησε μαζί με τα αδέρφια του Ηλία και Γιώργο και πολλούς συγγενείς του τον Παπαφλέσσα στο Μανιάκι όπου και θυσιάστηκε για την πατρίδα πολεμώντας τα στρατεύματα του Ιμπραήμ. Ο αδερφός του Γεώργιος Κορμάς που πολέμησε ηρωικά στο Μανιάκι διασώθηκε από θαύμα και όπως γράφει ο ίδιος στη μάχη του Μανιακίου χάθηκαν 70 συγγενείς του και συγχωριανοί του.
                </p>

            </section>

        </div>
    </section>


    <section id="one" class="wrapper">
        <div class="inner split">
            <section>
                <img src="{{ asset('1821/images/vic.png') }}" width="100%">
            </section>
            <section>
                <h2>Σχετικά με το Γριφομπότ της Επανάστασης</h2>
                <p>Το Γριφομπότ της Επανάστασης είναι ένα εκπαιδευτικό παιχνίδι που σαν σκοπό έχει να συγκεντρώσει πληροφορίες για τους δήμους όλης της Ελλάδας και να κάνει γνωστή την ιστορία που σχετίζεται με αυτούς και το 1821.

                </p>
                <p>Πρόκειται για το Γριφομπότ ΚΟΥΙΖ, ένα εκπαιδευτικό πρόγραμμα πιστοποιημένο από το Υπουργείο Παιδείας, μετά από θετική εισήγηση του Ινστιτούτου Εκπαιδευτικής Πολιτικής, με μία μικρή παραλλαγή ώστε να καλύπτει τη θεματική της ιστορίας και να περιλαμβάνει επιπλέον εκπαιδευτικά στοιχεία για κάθε δήμο.

                </p>
                <p>Το παιχνίδι είναι γνώσεων με ερωτήσεις πολλαπλής επιλογής. Οι ερωτήσεις πρέπει να επιλεγούν με τέτοιο τρόπο ώστε να φτιάχνεται το συντομότερο μονοπάτι. Κάθε συμμετέχοντας θα πρέπει, πριν ξεκινήσει το παιχνίδι, να αναγνώσει το κείμενο που υπάρχει, και στη συνέχεια να παίξει το παιχνίδι που περιλαμβάνει ερωτήσεις από το κείμενο που έχει διαβάσει αλλά και γενικές ερωτήσεις που αφορούν το 1821. Οι ερωτήσεις είναι χωρισμένες σε 3 διαφορετικά επίπεδα δυσκολίας. Κάθε ερώτηση, είτε απαντηθεί σωστά, είτε λάθος, ακολουθείται από επεξήγηση της σωστής απάντησης ολοκληρώνοντας με αυτό τον τρόπο τον εκπαιδευτικό χαρακτήρα του παιχνιδιού.

                </p>
                <p>Ο Δήμος Μεσσήνης είναι ο πρώτος δήμος που υλοποιεί το Γριφομπότ της Επανάστασης.

                </p>
                <p>Τα ιστορικά κείμενα έχουν καταγραφεί από τον κ. Αναστάσιο Αποστολόπουλο, διδάκτορα Παντείου Πανεπιστημίου-εκπαιδευτικό,  και παρουσιάζουν κάποια ενδεικτικά σημαντικά γεγονότα προκειμένου να μπορεί να λειτουργήσει το εκπαιδευτικό πρόγραμμα σε τοπικό επίπεδο.</p>
            </section>

        </div>
    </section>
@endsection