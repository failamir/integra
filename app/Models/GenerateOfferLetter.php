<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenerateOfferLetter extends Model
{
    protected $table = 'generate_offer_letters';
    protected $fillable = [
        'id',
        'lang',
        'content',
        'created_by',
    ];



    public static function replaceVariable($content, $obj)
    {
        $arrVariable = [
            '{applicant_name}',
            '{app_name}',
            '{job_title}',
            '{job_type}',
            '{start_date}',
            '{workplace_location}',
            '{days_of_week}',
            '{salary}',
            '{salary_type}',
            '{salary_duration}',
            '{next_pay_period}',
            '{offer_expiration_date}',


        ];
        $arrValue    = [
            'applicant_name' => '-',
            'app_name' => '-',
            'job_title' => '-',
            'job_type' => '-',
            'start_date' => '-',
            'workplace_location' => '-',
            'days_of_week' => '-',
            'salary'=>'-',
            'salary_type' => '-',
            'salary_duration' => '-',
            'next_pay_period' => '-',
            'offer_expiration_date' => '-',

        ];

        foreach($obj as $key => $val)
        {
            $arrValue[$key] = $val;
        }
        $settings = Utility::settings();

        //   dd(env('APP_NAME'));
        $arrValue['app_name']     = env('APP_NAME');


        return str_replace($arrVariable, array_values($arrValue), $content);
    }

    public static function defaultOfferLetter()
    {

        $defaultTemplate = [

                    'ar' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>رسالة عرض</strong></span></p>


                    <p>عزيزي {applicationant_name} ،</p>


                    <p>{app_name} متحمس لاصطحابك على متن الطائرة بصفتك {job_title}.</p>

                    <p>كنت على بعد خطوات قليلة من الشروع في العمل. يرجى أخذ الوقت الكافي لمراجعة عرضنا الرسمي. يتضمن تفاصيل مهمة حول راتبك ومزاياك وبنود وشروط عملك المتوقع مع {app_name}.</p>


                    <p>{app_name} يقدم {job_type}. المنصب بالنسبة لك كـ {job_title} ، تقديم التقارير إلى [المدير المباشر / المشرف] بدءًا من {start_date} في {workplace_location}. ساعات العمل المتوقعة هي {days_of_week}.</p>


                    <p>في هذا المنصب ، يعرض عليك {app_name}&nbsp; {salary}أن تبدأ لك بمعدل دفع {salary_type} لكل {salary_duration}. سوف يتم الدفع لك على أساس.</p>


                    <p>كجزء من تعويضك ، إذا كان ذلك ممكنًا ، ستصف مكافأتك ومشاركة الأرباح وهيكل العمولة وخيارات الأسهم وقواعد لجنة التعويضات هنا.</p>


                    <p>بصفتك موظفًا في {app_name} ، ستكون مؤهلاً للحصول على مزايا الاسم المختصر ، مثل التأمين الصحي ، وخطة الأسهم ، والتأمين على الأسنان ، وما إلى ذلك.</p>


                    <p>الرجاء توضيح موافقتك على هذه البنود وقبول هذا العرض عن طريق التوقيع على هذه الاتفاقية وتأريخها في أو قبل {offer_expiration_date}.</p>

                    <p>بإخلاص،</p>

                    <p>{app_name}</p>',

                    'zh' =>'<p style="text-align: center;"><strong>录取通知书</strong></p>

                    <p>亲爱的{applicant_name}，</p>

                    <p>{app_name} 很高兴邀请您担任 {job_title}。</p>

                    <p>只需办理一些手续就可以开始工作了。请花时间查看我们的正式报价。其中包括有关您的薪酬、福利以及您预期在 {app_name} 工作的条款和条件的重要详细信息。</p>

                    <p>{app_name} 正在提供{job_type}。您的职位为{job_title}，从{start_date}起在{workplace_location}向[直属经理/主管]汇报。预计工作时间为{days_of_week}。</p>

                    <p>在此职位上，{app_name} 提供的起始薪资为每 {salary_type} {salary}。您将按{salary_duration}获得报酬。 </p>

                    <p>作为薪酬的一部分，我们还提供[如果适用，您将在此处描述您的奖金、利润分享、佣金结构、股票期权和薪酬委员会规则]。</p>

                    <p>作为 {app_name} 的员工，您将有资格享受简单的福利，例如健康保险、股票计划、牙科保险等。</p>

                    <p>请在 {offer_expiration_date} 或之前签署本协议并注明日期，以表明您同意这些条款并接受此优惠。</p>

                    <p>真诚的，</p>

                    <p>{应用名称}</p>',


                    'da' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Tilbudsbrev</strong></span></p>

                    <p>K&aelig;re {applicant_name}</p>

                    <p>{app_name} er glade for at f&aring; dig med som {job_title}.</p>

                    <p>Der var kun et par formaliteter fra at komme p&aring; arbejde. Tag dig tid til at gennemg&aring; vores formelle tilbud. Den indeholder vigtige oplysninger om din kompensation, fordele og vilk&aring;rene og betingelserne for din forventede ans&aelig;ttelse hos {app_name}.</p>

                    <p>{app_name} tilbyder en {job_type}. stilling til dig som {job_title}, der rapporterer til [n&aelig;rmeste leder/supervisor] fra og med {start_date} p&aring;{workplace_location}. Forventet arbejdstid er {days_of_week}.</p>


                    <p>I denne stilling tilbyder {app_name} at starte dig med en l&oslash;nsats p&aring; {salary} pr. {salary_type}. Du vil blive betalt p&aring; {salary_duration}-basis.</p>

                    <p>Som en del af din kompensation, du ogs&aring; tilbyder, hvis det er relevant, vil du beskrive din bonus, overskudsdeling, kommissionsstruktur, aktieoptioner og regler for kompensationsudvalget her.</p>


                    <p>Som ansat hos {app_name} vil du v&aelig;re berettiget til kort navnefordele, s&aring;som sundhedsforsikring, aktieplan, tandforsikring osv.</p>

                    <p>Angiv venligst din accept af disse vilk&aring;r og accepter dette tilbud ved at underskrive og datere denne aftale p&aring; eller f&oslash;r {offer_expiration_date}.</p>

                    <p>Med venlig hilsen</p>

                    <p>{app_name}</p>',

                    'de' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Angebotsschreiben</strong></span></p>


                    <p>Sehr geehrter {applicant_name},</p>


                    <p>{app_name} freut sich, Sie als {job_title} an Bord zu holen.</p>


                    <p>Nur noch wenige Formalit&auml;ten bis zur Arbeit. Bitte nehmen Sie sich die Zeit, unser formelles Angebot zu pr&uuml;fen. Es enth&auml;lt wichtige Details zu Ihrer Verg&uuml;tung, Ihren Leistungen und den Bedingungen Ihrer voraussichtlichen Anstellung bei {app_name}.</p>


                    <p>{app_name} bietet einen {job_type} an. Position f&uuml;r Sie als {job_title}, ab {start_date} am {workplace_location} unterstellt an unmittelbarer Manager/Vorgesetzter. Erwartete Arbeitszeiten sind {days_of_week}.</p>


                    <p>In dieser Position bietet {app_name} Ihnen an, mit einem Gehaltssatz von {salary} pro {salary_type} zu beginnen. Sie werden auf Basis von {salary_duration} bezahlt.</p>


                    <p>Als Teil Ihrer Verg&uuml;tung, die Sie gegebenenfalls auch anbieten, beschreiben Sie hier Ihren Bonus, Ihre Gewinnbeteiligung, Ihre Provisionsstruktur, Ihre Aktienoptionen und die Regeln des Verg&uuml;tungsausschusses.</p>


                    <p>Als Mitarbeiter von {app_name} haben Sie Anspruch auf Kurznamenvorteile wie Krankenversicherung, Aktienplan, Zahnversicherung usw.</p>



                    <p>Bitte erkl&auml;ren Sie Ihr Einverst&auml;ndnis mit diesen Bedingungen und nehmen Sie dieses Angebot an, indem Sie diese Vereinbarung am oder vor dem {offer_expiration_date} unterzeichnen und datieren.</p>


                    <p>Aufrichtig,</p>

                    <p>{app_name}</p>',

                    'en' => '<p style="text-align: center;"><strong>Offer Letter</strong></p>

                    <p>Dear {applicant_name},</p>

                    <p>{app_name} is excited to bring you on board as {job_title}.</p>

                    <p>Were just a few formalities away from getting down to work. Please take the time to review our formal offer. It includes important details about your compensation, benefits, and the terms and conditions of your anticipated employment with {app_name}.</p>

                    <p>{app_name} is offering a {job_type}. position for you as {job_title}, reporting to [immediate manager/supervisor] starting on {start_date} at{workplace_location}. Expected hours of work are{days_of_week}.</p>

                    <p>In this position, {app_name} is offering to start you at a pay rate of {salary} per {salary_type}. You will be paid on a{salary_duration} basis.&nbsp;</p>

                    <p>As part of your compensation, were also offering [if applicable, youll describe your bonus, profit sharing, commission structure, stock options, and compensation committee rules here].</p>

                    <p>As an employee of {app_name} , you will be eligible for briefly name benefits, such as health insurance, stock plan, dental insurance, etc.</p>

                    <p>Please indicate your agreement with these terms and accept this offer by signing and dating this agreement on or before {offer_expiration_date}.</p>

                    <p>Sincerely,</p>

                    <p>{app_name}</p>',

                    'es' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Estimado {applicant_name},</p>

                    <p>{app_name} se complace en incorporarlo como {job_title}.</p>


                    <p>Faltaban s&oacute;lo unos tr&aacute;mites para ponerse manos a la obra. T&oacute;mese el tiempo para revisar nuestra oferta formal. Incluye detalles importantes sobre su compensaci&oacute;n, beneficios y los t&eacute;rminos y condiciones de su empleo anticipado con {app_name}.</p>


                    <p>{app_name} est&aacute; ofreciendo {job_type}. posici&oacute;n para usted como {job_title}, reportando al gerente/supervisor inmediato a partir del {start_date} en {workplace_location}. Las horas de trabajo esperadas son {days_of_week}.</p>


                    <p>En este puesto, {app_name} te ofrece comenzar con una tarifa de pago de {salary} por {salary_type}. Se le pagar&aacute; sobre la base de {salary_duration}.</p>


                    <p>Como parte de su compensaci&oacute;n, tambi&eacute;n ofrecemos, si corresponde, aqu&iacute; describir&aacute; su bonificaci&oacute;n, participaci&oacute;n en las ganancias, estructura de comisiones, opciones sobre acciones y reglas del comit&eacute; de compensaci&oacute;n.</p>


                    <p>Como empleado de {app_name}, ser&aacute; elegible para beneficios de nombre breve, como seguro m&eacute;dico, plan de acciones, seguro dental, etc.</p>


                    <p>Indique su acuerdo con estos t&eacute;rminos y acepte esta oferta firmando y fechando este acuerdo el {offer_expiration_date} o antes.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',

                    'fr' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Lettre doffre</strong></span></p>


                    <p>Cher {applicant_name},</p>


                    <p>{app_name} est ravi de vous accueillir en tant que {job_title}.</p>


                    <p>&Eacute;taient juste quelques formalit&eacute;s loin de se mettre au travail. Veuillez prendre le temps dexaminer notre offre formelle. Il comprend des d&eacute;tails importants sur votre r&eacute;mun&eacute;ration, vos avantages et les termes et conditions de votre emploi pr&eacute;vu avec {app_name}.</p>


                    <p>{app_name} propose un {job_type}. poste pour vous en tant que {job_title}, relevant du directeur/superviseur imm&eacute;diat &agrave; partir du {start_date} &agrave; {workplace_location}. Les heures de travail pr&eacute;vues sont de {days_of_week}.</p>


                    <p>&Agrave; ce poste, {app_name} vous propose de commencer avec un taux de r&eacute;mun&eacute;ration de {salary} par {salary_type}. Vous serez pay&eacute; sur une base de {salary_duration}.</p>


                    <p>Dans le cadre de votre r&eacute;mun&eacute;ration, le cas &eacute;ch&eacute;ant, vous d&eacute;crivez ici votre bonus, votre participation aux b&eacute;n&eacute;fices, votre structure de commission, vos options sur actions et les r&egrave;gles du comit&eacute; de r&eacute;mun&eacute;ration.</p>


                    <p>En tant quemploy&eacute; de {app_name}, vous aurez droit &agrave; des avantages bri&egrave;vement nomm&eacute;s, tels que lassurance maladie, le plan dactionnariat, lassurance dentaire, etc.</p>


                    <p>Veuillez indiquer votre accord avec ces conditions et accepter cette offre en signant et en datant cet accord au plus tard le {offer_expiration_date}.</p>


                    <p>Sinc&egrave;rement,</p>

                    <p>{app_name}</p>',

                    'he' =>'<p style="text-align: center;"><strong>מכתב הצעה</strong></p>

                    <p>{applicant_name} היקר,</p>

                    <p>{app_name} נרגש להעלות אותך לסיפון בתור {job_title}.</p>

                    <p>היו רק כמה פעולות פורמליות לפני היציאה לעבודה. אנא הקדישו זמן לעיון בהצעה הרשמית שלנו. הוא כולל פרטים חשובים על התגמול שלך, ההטבות והתנאים וההגבלות של העסקה הצפויה שלך עם {app_name}.</p>

                    <p>{app_name} מציע {job_type}. תפקיד עבורך בתור {job_title}, מדווח ל[מנהל/מפקח מיידי] החל מ-{start_date} ב-{workplace_location}. שעות העבודה הצפויות הן {days_of_week}.</p>

                    <p>בתפקיד זה, {app_name} מציע להתחיל אותך בשיעור שכר של {salary} לכל {salary_type}. תקבל תשלום על בסיס {salary_duration}. </p>

                    <p>כחלק מהתגמול שלך, הוצעו גם [אם רלוונטי, תתאר כאן את הבונוס, חלוקת הרווחים, מבנה העמלות, אופציות המניות וכללי ועדת התגמול שלך].</p>

                    <p>כעובד ב-{app_name} , אתה תהיה זכאי להטבות בקצרה, כגון ביטוח בריאות, תוכנית מניות, ביטוח שיניים וכו.</p>

                    <p>נא לציין את הסכמתך לתנאים אלה וקבל הצעה זו על ידי חתימה ותאריך הסכם זה בתאריך {offer_expiration_date} או לפני כן.</p>

                    <p>בכבוד רב,</p>

                    <p>{app_name}</p>',


                   'it' =>'<p style="text-align: center;"><strong>Lettera di offerta</strong></p>

                    <p>Gentile {applicant_name},</p>

                    <p>{app_name} è entusiasta di coinvolgerti come {job_title}.</p>

                    <p>Mancavano solo poche formalità per mettersi al lavoro. Si prega di prendere il tempo per rivedere la nostra offerta formale. Include dettagli importanti sulla tua retribuzione, benefici e termini e condizioni del tuo impiego previsto con {app_name}.</p>

                    <p>{app_name} offre un {job_type}. posizione per te come {job_title}, riportando a [immediate manager/supervisor] a partire dal {start_date} presso {workplace_location}. L orario di lavoro previsto è {giorni_della_settimana}.</p>

                    <p>In questa posizione, {app_name} si offre di iniziare con una retribuzione di {salary} per {salary_type}. Sarai pagato in base a {salary_duration}. </p>

                    <p>Come parte del tuo compenso, offriamo anche [se applicabile, descriverai qui il tuo bonus, la partecipazione agli utili, la struttura delle commissioni, le stock option e le regole del comitato per i compensi].</p>

                    <p>In qualità di dipendente di {app_name}, avrai diritto a vantaggi di nome breve, come l assicurazione sanitaria, il piano azionario, l assicurazione dentale e così via.</p>

                    <p>Indica il tuo accordo con questi termini e accetta questa offerta firmando e datando questo accordo entro il giorno {offer_expiration_date}.</p>

                    <p>Cordiali saluti,</p>

                    <p>{app_name}</p>',

                    'ja' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>内定通知</strong></span></p>


                    <p>{applicant_name} 様</p>

                    <p>{app_name} は、あなたを {job_title} として迎えることに興奮しています。</p>

                    <p>仕事に取り掛かる前に、ほんの少しの手続きがありました。時間をかけて正式なオファーを確認してください。これには、あなたの報酬、福利厚生、および {app_name} での予想される雇用条件に関する重要な詳細が含まれています。</p>

                    <p>{app_name} が {job_type} を提供しています。 {job_title} として、{start_date} から {workplace_location} の直属のマネージャー/スーパーバイザーに報告します。予想される勤務時間は {days_of_week} です。</p>

                    <p>このポジションでは、{app_name} は、{salary_type} あたり {salary} の賃金率であなたをスタートさせることを提案しています。 {salary_duration} 単位で支払われます。</p>

                    <p>報酬の一部として、該当する場合は提供もしていました。ボーナス、利益分配、手数料体系、ストック オプション、および報酬委員会の規則についてここに説明します。</p>

                    <p>{app_name} の従業員として、健康保険、ストック プラン、歯科保険などの簡単な名前の特典を受ける資格があります。</p>

                    <p>{offer_expiration_date} 日までに本契約に署名し日付を記入して、これらの条件に同意し、このオファーを受け入れてください。</p>

                    <p>心から、</p>

                    <p>{app_name}</p>',

                    'nl' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Aanbiedingsbrief</strong></span></p>



                    <p>Beste {applicant_name},</p>



                    <p>{app_name} is verheugd je aan boord te mogen verwelkomen als {job_title}.</p>



                    <p>Waren slechts een paar formaliteiten verwijderd om aan het werk te gaan. Neem de tijd om ons formele aanbod te bekijken. Het bevat belangrijke details over uw vergoeding, voordelen en de voorwaarden van uw verwachte dienstverband bij {app_name}.</p>



                    <p>{app_name} biedt een {job_type} aan. functie voor jou als {job_title}, rapporterend aan directe manager/supervisor vanaf {start_date} op {workplace_location}. De verwachte werkuren zijn {days_of_week}.</p>



                    <p>In deze functie biedt {app_name} aan om je te starten tegen een salaris van {salary} per {salary_type}. U wordt betaald op basis van {salary_duration}.</p>



                    <p>Als onderdeel van uw vergoeding, die u, indien van toepassing, ook aanbiedt, beschrijft u hier uw bonus, winstdeling, commissiestructuur, aandelenopties en regels van het vergoedingscomit&eacute;.</p>



                    <p>Als medewerker van {app_name} kom je in aanmerking voor korte naamvoordelen, zoals een ziektekostenverzekering, aandelenplan, tandartsverzekering, enz.</p>



                    <p>Geef aan dat u akkoord gaat met deze voorwaarden en accepteer deze aanbieding door deze overeenkomst op of v&oacute;&oacute;r {offer_expiration_date} te ondertekenen en te dateren.</p>



                    <p>Eerlijk,</p>

                    <p>{app_name}</p>',

                    'pl' => '<p style="text-align: center;"><strong><span style="font-size: 18pt;">List ofertowy</span></strong></p>

                    <p>Drogi {applicant_name},</p>

                    <p>{app_name} z radością zaprasza Cię do wsp&oacute;łpracy jako {job_title}.</p>

                    <p>Od rozpoczęcia pracy dzieliło mnie tylko kilka formalności. Prosimy o poświęcenie czasu na zapoznanie się z naszą oficjalną ofertą. Zawiera ważne szczeg&oacute;ły dotyczące Twojego wynagrodzenia, świadczeń oraz warunk&oacute;w Twojego przewidywanego zatrudnienia w {app_name}.</p>


                    <p>{app_name} oferuje {job_type}. stanowisko dla Ciebie jako {job_title}, raportowanie do bezpośredniego przełożonego/przełożonego począwszy od {start_date} w {workplace_location}. Przewidywane godziny pracy to {days_of_week}.</p>


                    <p>Na tym stanowisku {app_name} oferuje Ci rozpoczęcie pracy za stawkę {salary} za {salary_type}. Otrzymasz zapłatę na podstawie {salary_duration}.</p>


                    <p>W ramach wynagrodzenia, kt&oacute;re oferowaliśmy, jeśli dotyczy, opiszesz tutaj swoją premię, podział zysk&oacute;w, strukturę prowizji, opcje na akcje i zasady komitetu ds. Wynagrodzeń.</p>


                    <p>Jako pracownik {app_name} będziesz mieć prawo do kr&oacute;tkich imiennych świadczeń, takich jak ubezpieczenie zdrowotne, plan akcji, ubezpieczenie dentystyczne itp.</p>

                    <p>Zaznacz, że zgadzasz się z tymi warunkami i zaakceptuj tę ofertę, podpisując i datując tę ​​umowę w dniu {offer_expiration_date} lub wcześniej.</p>

                    <p>Z poważaniem,</p>

                    <p>{app_name}</p>',


                    'pt' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Prezado {applicant_name},</p>


                    <p>{app_name} tem o prazer de trazer voc&ecirc; a bordo como {job_title}.</p>


                    <p>Faltavam apenas algumas formalidades para come&ccedil;ar a trabalhar. Por favor, reserve um tempo para revisar nossa oferta formal. Ele inclui detalhes importantes sobre sua remunera&ccedil;&atilde;o, benef&iacute;cios e os termos e condi&ccedil;&otilde;es de seu emprego previsto com {app_name}.</p>


                    <p>{app_name} est&aacute; oferecendo um {job_type}. posi&ccedil;&atilde;o para voc&ecirc; como {job_title}, reportando-se ao gerente/supervisor imediato a partir de {start_date} em {workplace_location}. As horas de trabalho previstas s&atilde;o {days_of_week}.</p>


                    <p>Nesta posi&ccedil;&atilde;o, {app_name} est&aacute; oferecendo para voc&ecirc; come&ccedil;ar com uma taxa de pagamento de {salary} por {salary_type}. Voc&ecirc; ser&aacute; pago em uma base de {salary_duration}.</p>


                    <p>Como parte de sua remunera&ccedil;&atilde;o, tamb&eacute;m oferecida, se aplic&aacute;vel, voc&ecirc; descrever&aacute; seu b&ocirc;nus, participa&ccedil;&atilde;o nos lucros, estrutura de comiss&otilde;es, op&ccedil;&otilde;es de a&ccedil;&otilde;es e regras do comit&ecirc; de remunera&ccedil;&atilde;o aqui.</p>


                    <p>Como funcion&aacute;rio de {app_name} , voc&ecirc; se qualificar&aacute; para benef&iacute;cios de nome breve, como seguro sa&uacute;de, plano de a&ccedil;&otilde;es, seguro odontol&oacute;gico etc.</p>


                    <p>Indique sua concord&acirc;ncia com estes termos e aceite esta oferta assinando e datando este contrato em ou antes de {offer_expiration_date}.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',

                    'ru' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Письмо с предложением</strong></span></p>


                    <p>Уважаемый {applicant_name!</p>


                    <p>{app_name} рад предложить вам присоединиться к нам в качестве {job_title}.</p>


                    <p>Осталось всего несколько формальностей, чтобы приступить к работе. Пожалуйста, найдите время, чтобы ознакомиться с нашим официальным предложением. В нем содержится важная информация о вашем вознаграждении, льготах и ​​условиях вашего предполагаемого трудоустройства в {app_name}.</p>


                    <p>{app_name} предлагает {job_type}. должность для вас как {job_title}, подчинение непосредственному руководителю/руководителю начиная с {start_date} в {workplace_location}. Ожидаемое рабочее время: {days_of_week}.</p>


                    <p>На этой должности {app_name} предлагает вам начать работу со ставкой заработной платы {salary} за {salary_type}. Вам будут платить на основе {salary_duration}.</p>


                    <p>В рамках вашего вознаграждения мы также предлагаем, если это применимо, вы описываете свой бонус, распределение прибыли, структуру комиссионных, опционы на акции и правила компенсационного комитета здесь.</p>


                    <p>Как сотрудник {app_name}, вы будете иметь право на краткосрочные льготы, такие как медицинская страховка, план акций, стоматологическая страховка и т. д.</p>


                    <p>Пожалуйста, подтвердите свое согласие с этими условиями и примите это предложение, подписав и датировав это соглашение не позднее {offer_expiration_date}.</p>


                    <p>Искренне,</p>

                    <p>{app_name}</p>',

                    'tr' =>'<p style="text-align: center;"><strong>Teklif Mektubu</strong></p>

                    <p>Sayın {applicant_name},</p>

                    <p>{app_name}, sizi {job_title} olarak dahil etmekten heyecan duyuyor.</p>

                    <p>İşe başlamaktan sadece birkaç formalite uzaktaydı. Lütfen resmi teklifimizi incelemek için zaman ayırın. Maaşınız, avantajlarınız ve {app_name} ile tahmini istihdamınızın şart ve koşulları hakkında önemli ayrıntılar içerir.</p>

                    <p>{app_name}, bir {job_type} sunuyor. {job_title} olarak sizin için pozisyon, {start_date} tarihinden itibaren {workplace_location} adresinde [acil yönetici/denetçiye] rapor verecek. Beklenen çalışma saatleri: {days_of_week}.</p>

                    <p>Bu pozisyonda {app_name}, size {salary_type} başına {salary} ödeme oranıyla başlamanızı teklif ediyor. Size {salary_duration} bazında ödeme yapılacak. </p>

                    <p>Tazminatınızın bir parçası olarak [varsa ikramiyenizi, kâr paylaşımınızı, komisyon yapınızı, hisse senedi opsiyonlarınızı ve ücret komitesi kurallarınızı burada açıklayacaksınız] da teklif ediyoruz.</p>

                    <p>Bir {app_name} çalışanı olarak, sağlık sigortası, stok planı, diş sigortası vb. gibi kısaca isim haklarına hak kazanacaksınız.</p>

                    <p>Lütfen bu şartları kabul ettiğinizi belirtin ve bu sözleşmeyi {offer_expiration_date} tarihinde veya öncesinde imzalayıp tarih atarak bu teklifi kabul edin.</p>

                    <p>Saygılarımızla,</p>

                    <p>{uygulama_adı}</p>',

                    'pt-br' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Prezado {applicant_name},</p>


                    <p>{app_name} tem o prazer de trazer voc&ecirc; a bordo como {job_title}.</p>


                    <p>Faltavam apenas algumas formalidades para come&ccedil;ar a trabalhar. Por favor, reserve um tempo para revisar nossa oferta formal. Ele inclui detalhes importantes sobre sua remunera&ccedil;&atilde;o, benef&iacute;cios e os termos e condi&ccedil;&otilde;es de seu emprego previsto com {app_name}.</p>


                    <p>{app_name} est&aacute; oferecendo um {job_type}. posi&ccedil;&atilde;o para voc&ecirc; como {job_title}, reportando-se ao gerente/supervisor imediato a partir de {start_date} em {workplace_location}. As horas de trabalho previstas s&atilde;o {days_of_week}.</p>


                    <p>Nesta posi&ccedil;&atilde;o, {app_name} est&aacute; oferecendo para voc&ecirc; come&ccedil;ar com uma taxa de pagamento de {salary} por {salary_type}. Voc&ecirc; ser&aacute; pago em uma base de {salary_duration}.</p>


                    <p>Como parte de sua remunera&ccedil;&atilde;o, tamb&eacute;m oferecida, se aplic&aacute;vel, voc&ecirc; descrever&aacute; seu b&ocirc;nus, participa&ccedil;&atilde;o nos lucros, estrutura de comiss&otilde;es, op&ccedil;&otilde;es de a&ccedil;&otilde;es e regras do comit&ecirc; de remunera&ccedil;&atilde;o aqui.</p>


                    <p>Como funcion&aacute;rio de {app_name} , voc&ecirc; se qualificar&aacute; para benef&iacute;cios de nome breve, como seguro sa&uacute;de, plano de a&ccedil;&otilde;es, seguro odontol&oacute;gico etc.</p>


                    <p>Indique sua concord&acirc;ncia com estes termos e aceite esta oferta assinando e datando este contrato em ou antes de {offer_expiration_date}.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',

        ];


        foreach($defaultTemplate as $lang => $content)
        {
            GenerateOfferLetter::create(
                [
                    'lang' => $lang,
                    'content' => $content,
                    'created_by' => 2,

                ]
            );
        }

    }
    public static function defaultOfferLetterRegister($user_id)
    {

        $defaultTemplate = [

                    'ar' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>رسالة عرض</strong></span></p>


                    <p>عزيزي {applicationant_name} ،</p>


                    <p>{app_name} متحمس لاصطحابك على متن الطائرة بصفتك {job_title}.</p>

                    <p>كنت على بعد خطوات قليلة من الشروع في العمل. يرجى أخذ الوقت الكافي لمراجعة عرضنا الرسمي. يتضمن تفاصيل مهمة حول راتبك ومزاياك وبنود وشروط عملك المتوقع مع {app_name}.</p>


                    <p>{app_name} يقدم {job_type}. المنصب بالنسبة لك كـ {job_title} ، تقديم التقارير إلى [المدير المباشر / المشرف] بدءًا من {start_date} في {workplace_location}. ساعات العمل المتوقعة هي {days_of_week}.</p>


                    <p>في هذا المنصب ، يعرض عليك {app_name}&nbsp; {salary}أن تبدأ لك بمعدل دفع {salary_type} لكل {salary_duration}. سوف يتم الدفع لك على أساس.</p>


                    <p>كجزء من تعويضك ، إذا كان ذلك ممكنًا ، ستصف مكافأتك ومشاركة الأرباح وهيكل العمولة وخيارات الأسهم وقواعد لجنة التعويضات هنا.</p>


                    <p>بصفتك موظفًا في {app_name} ، ستكون مؤهلاً للحصول على مزايا الاسم المختصر ، مثل التأمين الصحي ، وخطة الأسهم ، والتأمين على الأسنان ، وما إلى ذلك.</p>


                    <p>الرجاء توضيح موافقتك على هذه البنود وقبول هذا العرض عن طريق التوقيع على هذه الاتفاقية وتأريخها في أو قبل {offer_expiration_date}.</p>

                    <p>بإخلاص،</p>

                    <p>{app_name}</p>',

                    'zh' =>'<p style="text-align: center;"><strong>录取通知书</strong></p>

                    <p>亲爱的{applicant_name}，</p>

                    <p>{app_name} 很高兴邀请您担任 {job_title}。</p>

                    <p>只需办理一些手续就可以开始工作了。请花时间查看我们的正式报价。其中包括有关您的薪酬、福利以及您预期在 {app_name} 工作的条款和条件的重要详细信息。</p>

                    <p>{app_name} 正在提供{job_type}。您的职位为{job_title}，从{start_date}起在{workplace_location}向[直属经理/主管]汇报。预计工作时间为{days_of_week}。</p>

                    <p>在此职位上，{app_name} 提供的起始薪资为每 {salary_type} {salary}。您将按{salary_duration}获得报酬。 </p>

                    <p>作为薪酬的一部分，我们还提供[如果适用，您将在此处描述您的奖金、利润分享、佣金结构、股票期权和薪酬委员会规则]。</p>

                    <p>作为 {app_name} 的员工，您将有资格享受简单的福利，例如健康保险、股票计划、牙科保险等。</p>

                    <p>请在 {offer_expiration_date} 或之前签署本协议并注明日期，以表明您同意这些条款并接受此优惠。</p>

                    <p>真诚的，</p>

                    <p>{应用名称}</p>',


                    'da' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Tilbudsbrev</strong></span></p>

                    <p>K&aelig;re {applicant_name}</p>

                    <p>{app_name} er glade for at f&aring; dig med som {job_title}.</p>

                    <p>Der var kun et par formaliteter fra at komme p&aring; arbejde. Tag dig tid til at gennemg&aring; vores formelle tilbud. Den indeholder vigtige oplysninger om din kompensation, fordele og vilk&aring;rene og betingelserne for din forventede ans&aelig;ttelse hos {app_name}.</p>

                    <p>{app_name} tilbyder en {job_type}. stilling til dig som {job_title}, der rapporterer til [n&aelig;rmeste leder/supervisor] fra og med {start_date} p&aring;{workplace_location}. Forventet arbejdstid er {days_of_week}.</p>


                    <p>I denne stilling tilbyder {app_name} at starte dig med en l&oslash;nsats p&aring; {salary} pr. {salary_type}. Du vil blive betalt p&aring; {salary_duration}-basis.</p>

                    <p>Som en del af din kompensation, du ogs&aring; tilbyder, hvis det er relevant, vil du beskrive din bonus, overskudsdeling, kommissionsstruktur, aktieoptioner og regler for kompensationsudvalget her.</p>


                    <p>Som ansat hos {app_name} vil du v&aelig;re berettiget til kort navnefordele, s&aring;som sundhedsforsikring, aktieplan, tandforsikring osv.</p>

                    <p>Angiv venligst din accept af disse vilk&aring;r og accepter dette tilbud ved at underskrive og datere denne aftale p&aring; eller f&oslash;r {offer_expiration_date}.</p>

                    <p>Med venlig hilsen</p>

                    <p>{app_name}</p>',
                    'de' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Angebotsschreiben</strong></span></p>


                    <p>Sehr geehrter {applicant_name},</p>


                    <p>{app_name} freut sich, Sie als {job_title} an Bord zu holen.</p>


                    <p>Nur noch wenige Formalit&auml;ten bis zur Arbeit. Bitte nehmen Sie sich die Zeit, unser formelles Angebot zu pr&uuml;fen. Es enth&auml;lt wichtige Details zu Ihrer Verg&uuml;tung, Ihren Leistungen und den Bedingungen Ihrer voraussichtlichen Anstellung bei {app_name}.</p>


                    <p>{app_name} bietet einen {job_type} an. Position f&uuml;r Sie als {job_title}, ab {start_date} am {workplace_location} unterstellt an unmittelbarer Manager/Vorgesetzter. Erwartete Arbeitszeiten sind {days_of_week}.</p>


                    <p>In dieser Position bietet {app_name} Ihnen an, mit einem Gehaltssatz von {salary} pro {salary_type} zu beginnen. Sie werden auf Basis von {salary_duration} bezahlt.</p>


                    <p>Als Teil Ihrer Verg&uuml;tung, die Sie gegebenenfalls auch anbieten, beschreiben Sie hier Ihren Bonus, Ihre Gewinnbeteiligung, Ihre Provisionsstruktur, Ihre Aktienoptionen und die Regeln des Verg&uuml;tungsausschusses.</p>


                    <p>Als Mitarbeiter von {app_name} haben Sie Anspruch auf Kurznamenvorteile wie Krankenversicherung, Aktienplan, Zahnversicherung usw.</p>



                    <p>Bitte erkl&auml;ren Sie Ihr Einverst&auml;ndnis mit diesen Bedingungen und nehmen Sie dieses Angebot an, indem Sie diese Vereinbarung am oder vor dem {offer_expiration_date} unterzeichnen und datieren.</p>


                    <p>Aufrichtig,</p>

                    <p>{app_name}</p>',
                    'en' => '<p style="text-align: center;"><strong>Offer Letter</strong></p>

                    <p>Dear {applicant_name},</p>

                    <p>{app_name} is excited to bring you on board as {job_title}.</p>

                    <p>Were just a few formalities away from getting down to work. Please take the time to review our formal offer. It includes important details about your compensation, benefits, and the terms and conditions of your anticipated employment with {app_name}.</p>

                    <p>{app_name} is offering a {job_type}. position for you as {job_title}, reporting to [immediate manager/supervisor] starting on {start_date} at{workplace_location}. Expected hours of work are{days_of_week}.</p>

                    <p>In this position, {app_name} is offering to start you at a pay rate of {salary} per {salary_type}. You will be paid on a{salary_duration} basis.&nbsp;</p>

                    <p>As part of your compensation, were also offering [if applicable, youll describe your bonus, profit sharing, commission structure, stock options, and compensation committee rules here].</p>

                    <p>As an employee of {app_name} , you will be eligible for briefly name benefits, such as health insurance, stock plan, dental insurance, etc.</p>

                    <p>Please indicate your agreement with these terms and accept this offer by signing and dating this agreement on or before {offer_expiration_date}.</p>

                    <p>Sincerely,</p>
                    <p>{app_name}</p>',
                    'es' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Estimado {applicant_name},</p>

                    <p>{app_name} se complace en incorporarlo como {job_title}.</p>


                    <p>Faltaban s&oacute;lo unos tr&aacute;mites para ponerse manos a la obra. T&oacute;mese el tiempo para revisar nuestra oferta formal. Incluye detalles importantes sobre su compensaci&oacute;n, beneficios y los t&eacute;rminos y condiciones de su empleo anticipado con {app_name}.</p>


                    <p>{app_name} est&aacute; ofreciendo {job_type}. posici&oacute;n para usted como {job_title}, reportando al gerente/supervisor inmediato a partir del {start_date} en {workplace_location}. Las horas de trabajo esperadas son {days_of_week}.</p>


                    <p>En este puesto, {app_name} te ofrece comenzar con una tarifa de pago de {salary} por {salary_type}. Se le pagar&aacute; sobre la base de {salary_duration}.</p>


                    <p>Como parte de su compensaci&oacute;n, tambi&eacute;n ofrecemos, si corresponde, aqu&iacute; describir&aacute; su bonificaci&oacute;n, participaci&oacute;n en las ganancias, estructura de comisiones, opciones sobre acciones y reglas del comit&eacute; de compensaci&oacute;n.</p>


                    <p>Como empleado de {app_name}, ser&aacute; elegible para beneficios de nombre breve, como seguro m&eacute;dico, plan de acciones, seguro dental, etc.</p>


                    <p>Indique su acuerdo con estos t&eacute;rminos y acepte esta oferta firmando y fechando este acuerdo el {offer_expiration_date} o antes.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',

                    'fr' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Lettre doffre</strong></span></p>


                    <p>Cher {applicant_name},</p>


                    <p>{app_name} est ravi de vous accueillir en tant que {job_title}.</p>


                    <p>&Eacute;taient juste quelques formalit&eacute;s loin de se mettre au travail. Veuillez prendre le temps dexaminer notre offre formelle. Il comprend des d&eacute;tails importants sur votre r&eacute;mun&eacute;ration, vos avantages et les termes et conditions de votre emploi pr&eacute;vu avec {app_name}.</p>


                    <p>{app_name} propose un {job_type}. poste pour vous en tant que {job_title}, relevant du directeur/superviseur imm&eacute;diat &agrave; partir du {start_date} &agrave; {workplace_location}. Les heures de travail pr&eacute;vues sont de {days_of_week}.</p>


                    <p>&Agrave; ce poste, {app_name} vous propose de commencer avec un taux de r&eacute;mun&eacute;ration de {salary} par {salary_type}. Vous serez pay&eacute; sur une base de {salary_duration}.</p>


                    <p>Dans le cadre de votre r&eacute;mun&eacute;ration, le cas &eacute;ch&eacute;ant, vous d&eacute;crivez ici votre bonus, votre participation aux b&eacute;n&eacute;fices, votre structure de commission, vos options sur actions et les r&egrave;gles du comit&eacute; de r&eacute;mun&eacute;ration.</p>


                    <p>En tant quemploy&eacute; de {app_name}, vous aurez droit &agrave; des avantages bri&egrave;vement nomm&eacute;s, tels que lassurance maladie, le plan dactionnariat, lassurance dentaire, etc.</p>


                    <p>Veuillez indiquer votre accord avec ces conditions et accepter cette offre en signant et en datant cet accord au plus tard le {offer_expiration_date}.</p>


                    <p>Sinc&egrave;rement,</p>
                    <p>{app_name}</p>',

                    'he' =>'<p style="text-align: center;"><strong>מכתב הצעה</strong></p>

                    <p>{applicant_name} היקר,</p>

                    <p>{app_name} נרגש להעלות אותך לסיפון בתור {job_title}.</p>

                    <p>היו רק כמה פעולות פורמליות לפני היציאה לעבודה. אנא הקדישו זמן לעיון בהצעה הרשמית שלנו. הוא כולל פרטים חשובים על התגמול שלך, ההטבות והתנאים וההגבלות של העסקה הצפויה שלך עם {app_name}.</p>

                    <p>{app_name} מציע {job_type}. תפקיד עבורך בתור {job_title}, מדווח ל[מנהל/מפקח מיידי] החל מ-{start_date} ב-{workplace_location}. שעות העבודה הצפויות הן {days_of_week}.</p>

                    <p>בתפקיד זה, {app_name} מציע להתחיל אותך בשיעור שכר של {salary} לכל {salary_type}. תקבל תשלום על בסיס {salary_duration}. </p>

                    <p>כחלק מהתגמול שלך, הוצעו גם [אם רלוונטי, תתאר כאן את הבונוס, חלוקת הרווחים, מבנה העמלות, אופציות המניות וכללי ועדת התגמול שלך].</p>

                    <p>כעובד ב-{app_name} , אתה תהיה זכאי להטבות בקצרה, כגון ביטוח בריאות, תוכנית מניות, ביטוח שיניים וכו.</p>

                    <p>נא לציין את הסכמתך לתנאים אלה וקבל הצעה זו על ידי חתימה ותאריך הסכם זה בתאריך {offer_expiration_date} או לפני כן.</p>

                    <p>בכבוד רב,</p>

                    <p>{app_name}</p>',



                    'it' =>'<p style="text-align: center;"><strong>Lettera di offerta</strong></p>

                    <p>Gentile {applicant_name},</p>

                    <p>{app_name} è entusiasta di coinvolgerti come {job_title}.</p>

                    <p>Mancavano solo poche formalità per mettersi al lavoro. Si prega di prendere il tempo per rivedere la nostra offerta formale. Include dettagli importanti sulla tua retribuzione, benefici e termini e condizioni del tuo impiego previsto con {app_name}.</p>

                    <p>{app_name} offre un {job_type}. posizione per te come {job_title}, riportando a [immediate manager/supervisor] a partire dal {start_date} presso {workplace_location}. L orario di lavoro previsto è {giorni_della_settimana}.</p>

                    <p>In questa posizione, {app_name} si offre di iniziare con una retribuzione di {salary} per {salary_type}. Sarai pagato in base a {salary_duration}. </p>

                    <p>Come parte del tuo compenso, offriamo anche [se applicabile, descriverai qui il tuo bonus, la partecipazione agli utili, la struttura delle commissioni, le stock option e le regole del comitato per i compensi].</p>

                    <p>In qualità di dipendente di {app_name}, avrai diritto a vantaggi di nome breve, come l assicurazione sanitaria, il piano azionario, l assicurazione dentale e così via.</p>

                    <p>Indica il tuo accordo con questi termini e accetta questa offerta firmando e datando questo accordo entro il giorno {offer_expiration_date}.</p>

                    <p>Cordiali saluti,</p>

                    <p>{app_name}</p>',


                    'ja' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>内定通知</strong></span></p>


                    <p>{applicant_name} 様</p>

                    <p>{app_name} は、あなたを {job_title} として迎えることに興奮しています。</p>

                    <p>仕事に取り掛かる前に、ほんの少しの手続きがありました。時間をかけて正式なオファーを確認してください。これには、あなたの報酬、福利厚生、および {app_name} での予想される雇用条件に関する重要な詳細が含まれています。</p>

                    <p>{app_name} が {job_type} を提供しています。 {job_title} として、{start_date} から {workplace_location} の直属のマネージャー/スーパーバイザーに報告します。予想される勤務時間は {days_of_week} です。</p>

                    <p>このポジションでは、{app_name} は、{salary_type} あたり {salary} の賃金率であなたをスタートさせることを提案しています。 {salary_duration} 単位で支払われます。</p>

                    <p>報酬の一部として、該当する場合は提供もしていました。ボーナス、利益分配、手数料体系、ストック オプション、および報酬委員会の規則についてここに説明します。</p>

                    <p>{app_name} の従業員として、健康保険、ストック プラン、歯科保険などの簡単な名前の特典を受ける資格があります。</p>

                    <p>{offer_expiration_date} 日までに本契約に署名し日付を記入して、これらの条件に同意し、このオファーを受け入れてください。</p>

                    <p>心から、</p>

                    <p>{app_name}</p>',

                    'nl' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Aanbiedingsbrief</strong></span></p>


                    <p>Beste {applicant_name},</p>



                    <p>{app_name} is verheugd je aan boord te mogen verwelkomen als {job_title}.</p>



                    <p>Waren slechts een paar formaliteiten verwijderd om aan het werk te gaan. Neem de tijd om ons formele aanbod te bekijken. Het bevat belangrijke details over uw vergoeding, voordelen en de voorwaarden van uw verwachte dienstverband bij {app_name}.</p>



                    <p>{app_name} biedt een {job_type} aan. functie voor jou als {job_title}, rapporterend aan directe manager/supervisor vanaf {start_date} op {workplace_location}. De verwachte werkuren zijn {days_of_week}.</p>



                    <p>In deze functie biedt {app_name} aan om je te starten tegen een salaris van {salary} per {salary_type}. U wordt betaald op basis van {salary_duration}.</p>



                    <p>Als onderdeel van uw vergoeding, die u, indien van toepassing, ook aanbiedt, beschrijft u hier uw bonus, winstdeling, commissiestructuur, aandelenopties en regels van het vergoedingscomit&eacute;.</p>



                    <p>Als medewerker van {app_name} kom je in aanmerking voor korte naamvoordelen, zoals een ziektekostenverzekering, aandelenplan, tandartsverzekering, enz.</p>



                    <p>Geef aan dat u akkoord gaat met deze voorwaarden en accepteer deze aanbieding door deze overeenkomst op of v&oacute;&oacute;r {offer_expiration_date} te ondertekenen en te dateren.</p>



                    <p>Eerlijk,</p>

                    <p>{app_name}</p>',
                    'pl' => '<p style="text-align: center;"><strong><span style="font-size: 18pt;">List ofertowy</span></strong></p>

                    <p>Drogi {applicant_name},</p>

                    <p>{app_name} z radością zaprasza Cię do wsp&oacute;łpracy jako {job_title}.</p>

                    <p>Od rozpoczęcia pracy dzieliło mnie tylko kilka formalności. Prosimy o poświęcenie czasu na zapoznanie się z naszą oficjalną ofertą. Zawiera ważne szczeg&oacute;ły dotyczące Twojego wynagrodzenia, świadczeń oraz warunk&oacute;w Twojego przewidywanego zatrudnienia w {app_name}.</p>


                    <p>{app_name} oferuje {job_type}. stanowisko dla Ciebie jako {job_title}, raportowanie do bezpośredniego przełożonego/przełożonego począwszy od {start_date} w {workplace_location}. Przewidywane godziny pracy to {days_of_week}.</p>


                    <p>Na tym stanowisku {app_name} oferuje Ci rozpoczęcie pracy za stawkę {salary} za {salary_type}. Otrzymasz zapłatę na podstawie {salary_duration}.</p>


                    <p>W ramach wynagrodzenia, kt&oacute;re oferowaliśmy, jeśli dotyczy, opiszesz tutaj swoją premię, podział zysk&oacute;w, strukturę prowizji, opcje na akcje i zasady komitetu ds. Wynagrodzeń.</p>


                    <p>Jako pracownik {app_name} będziesz mieć prawo do kr&oacute;tkich imiennych świadczeń, takich jak ubezpieczenie zdrowotne, plan akcji, ubezpieczenie dentystyczne itp.</p>

                    <p>Zaznacz, że zgadzasz się z tymi warunkami i zaakceptuj tę ofertę, podpisując i datując tę ​​umowę w dniu {offer_expiration_date} lub wcześniej.</p>

                    <p>Z poważaniem,</p>

                    <p>{app_name}</p>',
                    'pt' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Prezado {applicant_name},</p>


                    <p>{app_name} tem o prazer de trazer voc&ecirc; a bordo como {job_title}.</p>


                    <p>Faltavam apenas algumas formalidades para come&ccedil;ar a trabalhar. Por favor, reserve um tempo para revisar nossa oferta formal. Ele inclui detalhes importantes sobre sua remunera&ccedil;&atilde;o, benef&iacute;cios e os termos e condi&ccedil;&otilde;es de seu emprego previsto com {app_name}.</p>


                    <p>{app_name} est&aacute; oferecendo um {job_type}. posi&ccedil;&atilde;o para voc&ecirc; como {job_title}, reportando-se ao gerente/supervisor imediato a partir de {start_date} em {workplace_location}. As horas de trabalho previstas s&atilde;o {days_of_week}.</p>


                    <p>Nesta posi&ccedil;&atilde;o, {app_name} est&aacute; oferecendo para voc&ecirc; come&ccedil;ar com uma taxa de pagamento de {salary} por {salary_type}. Voc&ecirc; ser&aacute; pago em uma base de {salary_duration}.</p>


                    <p>Como parte de sua remunera&ccedil;&atilde;o, tamb&eacute;m oferecida, se aplic&aacute;vel, voc&ecirc; descrever&aacute; seu b&ocirc;nus, participa&ccedil;&atilde;o nos lucros, estrutura de comiss&otilde;es, op&ccedil;&otilde;es de a&ccedil;&otilde;es e regras do comit&ecirc; de remunera&ccedil;&atilde;o aqui.</p>


                    <p>Como funcion&aacute;rio de {app_name} , voc&ecirc; se qualificar&aacute; para benef&iacute;cios de nome breve, como seguro sa&uacute;de, plano de a&ccedil;&otilde;es, seguro odontol&oacute;gico etc.</p>


                    <p>Indique sua concord&acirc;ncia com estes termos e aceite esta oferta assinando e datando este contrato em ou antes de {offer_expiration_date}.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',
                    'ru' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Письмо с предложением</strong></span></p>


                    <p>Уважаемый {applicant_name!</p>


                    <p>{app_name} рад предложить вам присоединиться к нам в качестве {job_title}.</p>


                    <p>Осталось всего несколько формальностей, чтобы приступить к работе. Пожалуйста, найдите время, чтобы ознакомиться с нашим официальным предложением. В нем содержится важная информация о вашем вознаграждении, льготах и ​​условиях вашего предполагаемого трудоустройства в {app_name}.</p>


                    <p>{app_name} предлагает {job_type}. должность для вас как {job_title}, подчинение непосредственному руководителю/руководителю начиная с {start_date} в {workplace_location}. Ожидаемое рабочее время: {days_of_week}.</p>


                    <p>На этой должности {app_name} предлагает вам начать работу со ставкой заработной платы {salary} за {salary_type}. Вам будут платить на основе {salary_duration}.</p>


                    <p>В рамках вашего вознаграждения мы также предлагаем, если это применимо, вы описываете свой бонус, распределение прибыли, структуру комиссионных, опционы на акции и правила компенсационного комитета здесь.</p>


                    <p>Как сотрудник {app_name}, вы будете иметь право на краткосрочные льготы, такие как медицинская страховка, план акций, стоматологическая страховка и т. д.</p>


                    <p>Пожалуйста, подтвердите свое согласие с этими условиями и примите это предложение, подписав и датировав это соглашение не позднее {offer_expiration_date}.</p>


                    <p>Искренне,</p>


                    <p>{app_name}</p>',


                    'tr' =>'<p style="text-align: center;"><strong>Teklif Mektubu</strong></p>

                    <p>Sayın {applicant_name},</p>

                    <p>{app_name}, sizi {job_title} olarak dahil etmekten heyecan duyuyor.</p>

                    <p>İşe başlamaktan sadece birkaç formalite uzaktaydı. Lütfen resmi teklifimizi incelemek için zaman ayırın. Maaşınız, avantajlarınız ve {app_name} ile tahmini istihdamınızın şart ve koşulları hakkında önemli ayrıntılar içerir.</p>

                    <p>{app_name}, bir {job_type} sunuyor. {job_title} olarak sizin için pozisyon, {start_date} tarihinden itibaren {workplace_location} adresinde [acil yönetici/denetçiye] rapor verecek. Beklenen çalışma saatleri: {days_of_week}.</p>

                    <p>Bu pozisyonda {app_name}, size {salary_type} başına {salary} ödeme oranıyla başlamanızı teklif ediyor. Size {salary_duration} bazında ödeme yapılacak. </p>

                    <p>Tazminatınızın bir parçası olarak [varsa ikramiyenizi, kâr paylaşımınızı, komisyon yapınızı, hisse senedi opsiyonlarınızı ve ücret komitesi kurallarınızı burada açıklayacaksınız] da teklif ediyoruz.</p>

                    <p>Bir {app_name} çalışanı olarak, sağlık sigortası, stok planı, diş sigortası vb. gibi kısaca isim haklarına hak kazanacaksınız.</p>

                    <p>Lütfen bu şartları kabul ettiğinizi belirtin ve bu sözleşmeyi {offer_expiration_date} tarihinde veya öncesinde imzalayıp tarih atarak bu teklifi kabul edin.</p>

                    <p>Saygılarımızla,</p>

                    <p>{uygulama_adı}</p>',

                    'pt-br' => '<p style="text-align: center;"><span style="font-size: 18pt;"><strong>Carta de oferta</strong></span></p>


                    <p>Prezado {applicant_name},</p>


                    <p>{app_name} tem o prazer de trazer voc&ecirc; a bordo como {job_title}.</p>


                    <p>Faltavam apenas algumas formalidades para come&ccedil;ar a trabalhar. Por favor, reserve um tempo para revisar nossa oferta formal. Ele inclui detalhes importantes sobre sua remunera&ccedil;&atilde;o, benef&iacute;cios e os termos e condi&ccedil;&otilde;es de seu emprego previsto com {app_name}.</p>


                    <p>{app_name} est&aacute; oferecendo um {job_type}. posi&ccedil;&atilde;o para voc&ecirc; como {job_title}, reportando-se ao gerente/supervisor imediato a partir de {start_date} em {workplace_location}. As horas de trabalho previstas s&atilde;o {days_of_week}.</p>


                    <p>Nesta posi&ccedil;&atilde;o, {app_name} est&aacute; oferecendo para voc&ecirc; come&ccedil;ar com uma taxa de pagamento de {salary} por {salary_type}. Voc&ecirc; ser&aacute; pago em uma base de {salary_duration}.</p>


                    <p>Como parte de sua remunera&ccedil;&atilde;o, tamb&eacute;m oferecida, se aplic&aacute;vel, voc&ecirc; descrever&aacute; seu b&ocirc;nus, participa&ccedil;&atilde;o nos lucros, estrutura de comiss&otilde;es, op&ccedil;&otilde;es de a&ccedil;&otilde;es e regras do comit&ecirc; de remunera&ccedil;&atilde;o aqui.</p>


                    <p>Como funcion&aacute;rio de {app_name} , voc&ecirc; se qualificar&aacute; para benef&iacute;cios de nome breve, como seguro sa&uacute;de, plano de a&ccedil;&otilde;es, seguro odontol&oacute;gico etc.</p>


                    <p>Indique sua concord&acirc;ncia com estes termos e aceite esta oferta assinando e datando este contrato em ou antes de {offer_expiration_date}.</p>


                    <p>Sinceramente,</p>

                    <p>{app_name}</p>',

        ];


        foreach($defaultTemplate as $lang => $content)
        {
            GenerateOfferLetter::create(
                [
                    'lang' => $lang,
                    'content' => $content,
                    'created_by' => $user_id,

                ]
            );
        }

    }


}
