<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JoiningLetter extends Model
{
    protected $table = 'joining_letters';
    protected $fillable = [
        'id',
        'lang',
        'content',
        'created_by',
    ];
    public static function replaceVariable($content, $obj)
    {
        $arrVariable = [
            '{date}',
            '{app_name}',
            '{employee_name}',
            '{address}',
            '{start_date}',
            '{designation}',
            '{branch}',
            '{start_time}',
            '{end_time}',
            '{total_hours}',


        ];
        $arrValue    = [
            'date' => '-',
            'app_name' => '-',
            'employee_name' => '-',
            'address' => '-',
            'start_date' => '-',
            'designation' => '-',
            'branch' => '-',
            'start_time' => '-',
            'end_time' => '-',
            'total_hours' => '-',

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
    public static function defaultJoiningLetter()
    {

        $defaultTemplate = [

            'ar' => '<h2 style="text-align: center;"><strong>خطاب الانضمام</strong></h2>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>الموضوع: موعد لوظيفة {designation}</p>
            <p>عزيزي {employee_name} ،</p>
            <p>يسعدنا أن نقدم لك منصب {designation} مع {app_name} "الشركة" وفقًا للشروط التالية و</p>
            <p>الظروف:</p>
            <p>1. بدء العمل</p>
            <p>سيصبح عملك ساريًا اعتبارًا من {start_date}</p>
            <p>2. المسمى الوظيفي</p>
            <p>سيكون المسمى الوظيفي الخاص بك هو {designation}.</p>
            <p>3. الراتب</p>
            <p>سيكون راتبك والمزايا الأخرى على النحو المبين في الجدول 1 ، طيه.</p>
            <p>4. مكان الإرسال</p>
            <p>سيتم إرسالك إلى {branch}. ومع ذلك ، قد يُطلب منك العمل في أي مكان عمل تمتلكه الشركة ، أو</p>
            <p>قد تحصل لاحقًا.</p>
            <p>5. ساعات العمل</p>
            <p>أيام العمل العادية هي من الاثنين إلى الجمعة. سيُطلب منك العمل لساعات حسب الضرورة لـ</p>
            <p>أداء واجباتك على النحو الصحيح تجاه الشركة. ساعات العمل العادية من {start_time} إلى {end_time} وأنت</p>
            <p>من المتوقع أن يعمل ما لا يقل عن {total_hours} ساعة كل أسبوع ، وإذا لزم الأمر لساعات إضافية اعتمادًا على</p>
            <p>المسؤوليات.</p>
            <p>6. الإجازة / العطل</p>
            <p>6.1 يحق لك الحصول على إجازة غير رسمية مدتها 12 يومًا.</p>
            <p>6.2 يحق لك الحصول على إجازة مرضية مدفوعة الأجر لمدة 12 يوم عمل.</p>
            <p>6.3 تخطر الشركة بقائمة الإجازات المعلنة في بداية كل عام.</p>
            <p>7. طبيعة الواجبات</p>
            <p>ستقوم بأداء أفضل ما لديك من واجبات متأصلة في منصبك ومهام إضافية مثل الشركة</p>
            <p>قد يدعوك لأداء ، من وقت لآخر. واجباتك المحددة منصوص عليها في الجدول الثاني بهذه الرسالة.</p>
            <p>8. ممتلكات الشركة</p>
            <p>ستحافظ دائمًا على ممتلكات الشركة في حالة جيدة ، والتي قد يتم تكليفك بها للاستخدام الرسمي خلال فترة عملها</p>
            <p>عملك ، ويجب أن تعيد جميع هذه الممتلكات إلى الشركة قبل التخلي عن الرسوم الخاصة بك ، وإلا فإن التكلفة</p>
            <p>نفس الشيء سوف تسترده منك الشركة.</p>
            <p>9. الاقتراض / قبول الهدايا</p>
            <p>لن تقترض أو تقبل أي أموال أو هدية أو مكافأة أو تعويض مقابل مكاسبك الشخصية من أو تضع نفسك بأي طريقة أخرى</p>
            <p>بموجب التزام مالي تجاه أي شخص / عميل قد تكون لديك تعاملات رسمية معه.</p>
            <p>10. الإنهاء</p>
            <p>10.1 يمكن للشركة إنهاء موعدك ، دون أي سبب ، من خلال إعطائك ما لا يقل عن [إشعار] قبل أشهر</p>
            <p>إشعار خطي أو راتب بدلاً منه. لغرض هذا البند ، يقصد بالراتب المرتب الأساسي.</p>
            <p>10.2 إنهاء عملك مع الشركة ، دون أي سبب ، من خلال تقديم ما لا يقل عن إشعار الموظف</p>
            <p>أشهر الإخطار أو الراتب عن الفترة غير المحفوظة ، المتبقية بعد تعديل الإجازات المعلقة ، كما في التاريخ.</p>
            <p>10.3 تحتفظ الشركة بالحق في إنهاء عملك بإيجاز دون أي فترة إشعار أو مدفوعات إنهاء</p>
            <p>إذا كان لديه سبب معقول للاعتقاد بأنك مذنب بسوء السلوك أو الإهمال ، أو ارتكبت أي خرق جوهري لـ</p>
            <p>العقد ، أو تسبب في أي خسارة للشركة.</p>
            <p>10. 4 عند إنهاء عملك لأي سبب من الأسباب ، ستعيد إلى الشركة جميع ممتلكاتك ؛ المستندات و</p>
            <p>الأوراق الأصلية ونسخها ، بما في ذلك أي عينات ، وأدبيات ، وعقود ، وسجلات ، وقوائم ، ورسومات ، ومخططات ،</p>
            <p>الرسائل والملاحظات والبيانات وما شابه ذلك ؛ والمعلومات السرية التي بحوزتك أو تحت سيطرتك والمتعلقة بك</p>
            <p>التوظيف أو الشؤون التجارية للعملاء.</p>
            <p>11. المعلومات السرية</p>
            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>
            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>
            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>
            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>
            <p>شركة.</p>
            <p>11. المعلومات السرية</p>
            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>
            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>
            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>
            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>
            <p>شركة.</p>
            <p>11.2 يجب عليك دائمًا الحفاظ على أعلى درجة من السرية والحفاظ على سرية السجلات والوثائق وغيرها</p>
            <p>المعلومات السرية المتعلقة بأعمال الشركة والتي قد تكون معروفة لك أو مخولة لك بأي وسيلة</p>
            <p>ولن تستخدم هذه السجلات والمستندات والمعلومات إلا بالطريقة المصرح بها حسب الأصول لصالح الشركة. إلى عن على</p>
            <p>أغراض هذا البند "المعلومات السرية" تعني المعلومات المتعلقة بأعمال الشركة وعملائها</p>
            <p>التي لا تتوفر لعامة الناس والتي قد تتعلمها أثناء عملك. هذا يشمل،</p>
            <p>على سبيل المثال لا الحصر ، المعلومات المتعلقة بالمنظمة وقوائم العملاء وسياسات التوظيف والموظفين والمعلومات</p>
            <p>حول منتجات الشركة وعملياتها بما في ذلك الأفكار والمفاهيم والإسقاطات والتكنولوجيا والكتيبات والرسم والتصاميم ،</p>
            <p>المواصفات وجميع الأوراق والسير الذاتية والسجلات والمستندات الأخرى التي تحتوي على هذه المعلومات السرية.</p>
            <p>11.3 لن تقوم في أي وقت بإزالة أي معلومات سرية من المكتب دون إذن.</p>

            <p>11.4 واجبك في الحماية وعدم الإفشاء</p>

            <p>تظل المعلومات السرية سارية بعد انتهاء أو إنهاء هذه الاتفاقية و / أو عملك مع الشركة.</p>

            <p>11.5 سوف يجعلك خرق شروط هذا البند عرضة للفصل بإجراءات موجزة بموجب الفقرة أعلاه بالإضافة إلى أي</p>

            <p>أي تعويض آخر قد يكون للشركة ضدك في القانون.</p>

            <p>12. الإخطارات</p>

            <p>يجوز لك إرسال إخطارات إلى الشركة على عنوان مكتبها المسجل. يمكن أن ترسل لك الشركة إشعارات على</p>

            <p>العنوان الذي أشرت إليه في السجلات الرسمية.</p>



            <p>13. تطبيق سياسة الشركة</p>

            <p>يحق للشركة تقديم إعلانات السياسة من وقت لآخر فيما يتعلق بمسائل مثل استحقاق الإجازة والأمومة</p>

            <p>الإجازة ، ومزايا الموظفين ، وساعات العمل ، وسياسات النقل ، وما إلى ذلك ، ويمكن تغييرها من وقت لآخر وفقًا لتقديرها الخاص.</p>

            <p>جميع قرارات سياسة الشركة هذه ملزمة لك ويجب أن تلغي هذه الاتفاقية إلى هذا الحد.</p>



            <p>14. القانون الحاكم / الاختصاص القضائي</p>

            <p>يخضع عملك في الشركة لقوانين الدولة. تخضع جميع النزاعات للاختصاص القضائي للمحكمة العليا</p>

            <p>غوجارات فقط.</p>



            <p>15. قبول عرضنا</p>

            <p>يرجى تأكيد قبولك لعقد العمل هذا من خلال التوقيع وإعادة النسخة المكررة.</p>



            <p>نرحب بكم ونتطلع إلى تلقي موافقتكم والعمل معكم.</p>



            <p>تفضلوا بقبول فائق الاحترام،</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'zh' =>'<h3 style="text-align: center;">加入信</h3>
            <p>{日期}</p>
            <p>{employee_name}</p>
            <p>{地址}</p>
            <p>主题：任命 {designation} 职位</p>
            <p>亲爱的{employee_name}，</p>
            <p>我们很高兴根据以下条款向您提供 {app_name} theCompany 的 {designation} 职位，并且</p>
            <p>条件：</p>
            <p>1.开始就业</p>
            <p>您的雇佣关系将于 {start_date}起生效</p>
            <p>2.职位名称</p>
            <p>您的职位名称为{designation}。</p>
            <p>3.薪资</p>
            <p>您的工资和其他福利将在附表 1 中列出。</p>
            <p>4.发帖地点</p>
            <p>您将被调往{branch}。但是，您可能需要在公司拥有的任何营业地点工作，或者</p>
            <p>稍后可能会获得。</p>
            <p>5.工作时间</p>
            <p>正常工作日为周一至周五。您将需要在必要的时间内工作</p>
            <p>正确履行您对公司的职责。正常工作时间为 {start_time} 至 {end_time}，您</p>
            <p>预计每周工作不少于 {total_hours} 小时，如有必要，可根据您的情况增加工作时间</p>
            <p>职责。</p>
            <p>6.休假/节假日</p>
            <p>6.1 您有权享受 12 天的事假。</p>
            <p>6.2 您有权享受 12 个工作日的带薪病假。</p>
            <p>6.3 公司应在每年年初公布已宣布的假期清单。</p>
            <p>7.职责性质</p>
            <p>您将尽最大努力履行您职位固有的所有职责以及公司的额外职责</p>
            <p>可能会不时要求您表演。您的具体职责详见附表二。</p>
            <p>8.公司财产</p>
            <p>您将始终保持公司财产处于良好状态，这些财产可能会在工作期间委托给您用于官方使用</p>
            <p>您的工作，并应在放弃您的费用之前将所有此类财产归还给公司，否则费用</p>
            <p>公司将向您追回相同的内容。</p>
            <p>9.借用/接受礼物</p>
            <p>您不会借用或接受任何金钱、礼物、奖励或补偿来获取个人利益或以其他方式安置自己</p>
            <p>对可能与您进行正式交易的任何个人/客户承担金钱义务。</p>
            <p>10。终止</p>
            <p>10.1 公司可以在至少提前 [通知] 个月之前向您发出无任何理由的终止您的任命</p>
            <p>书面通知或工资代替。本条款中的工资是指基本工资。</p>
            <p>10.2 您可以通过发出不少于[员工通知]来终止与公司的雇佣关系，无需任何理由</p>
            <p>未保存期间的提前几个月通知或工资，在待休假调整后剩余，截至日期。</p>
            <p>10.3 公司保留立即终止您的雇佣关系的权利，无需任何通知期或终止付款</p>
            <p>如果有合理理由相信您犯有不当行为或疏忽，或犯有任何根本性违规行为</p>
            <p>合同，或给公司造成任何损失。</p>
            <p>10。 4.无论因何种原因终止雇佣关系，您应将所有财产返还给公司；文件，以及</p>
            <p>纸张，包括原件和副本，包括任何样本、文献、合同、记录、清单、图纸、蓝图，</p>
            <p>信件、笔记、数据等；您拥有或控制下的与您相关的机密信息</p>
            <p>就业或客户商务事务。</p>
            <p>11。机密信息</p>
            <p>11。 1 在您就职于公司期间，您将尽最大努力投入全部时间、注意力和技能，以实现</p>
            <p>它的业务。您不得直接或间接与以下人员接触或交往、与之有联系、涉及、受雇或参与</p>
            <p>未经公司事先许可，花时间或参加任何学习课程。从事任何其他业务或</p>
            <p>未经事先许可，进行活动或任何其他职位或兼职工作或进行任何学习课程</p>
            <p>公司。</p>
            <p>11.2 您必须始终保持最高程度的机密性，并对记录、文件和其他内容保密</p>
            <p>您可能知道或通过任何方式向您透露的与公司业务相关的机密信息</p>
            <p>您只能以符合公司利益的正式授权方式使用此类记录、文件和信息。对于</p>
            <p>本条款的目的机密信息是指有关公司业务及其客户业务的信息</p>
            <p>这对公众来说是无法获得的，但您可以在工作过程中了解到。这包括，</p>
            <p>但不限于与组织、其客户名单、雇佣政策、人员和信息相关的信息</p>
            <p>关于公司的产品、流程，包括想法、概念、预测、技术、手册、绘图、设计，</p>
            <p>规范以及包含此类机密信息的所有文件、简历、记录和其他文件。</p>
            <p>11.3 未经许可，您不得从办公室删除任何机密信息。</p>
            <p>11.4 您的保护义务和不披露义务</p>
            <p>在本协议期满或终止和/或您在公司任职后，机密信息将继续有效。</p>
            <p>11.5 违反本条款的条件将使您根据上述条款承担立即解雇的责任，此外还有任何责任</p>
            <p>公司可能根据法律对您采取的其他补救措施。</p>
            <p>12.通知</p>
            <p>您可以通过公司的注册办公地址向公司发出通知。公司可能会通过以下地址向您发出通知：</p>
            <p>您在官方记录中透露的地址。</p>
            <p>13。公司政策的适用性</p>
            <p>公司有权不时就休假、生育等事宜作出政策声明</p>
            <p>休假、员工福利、工作时间、调动政策等，并可能自行决定不时进行更改。</p>
            <p>公司的所有此类政策决定均对您具有约束力，并在一定程度上优先于本协议。</p>
            <p>14。适用法律/司法管辖区</p>
            <p>您在公司的雇佣关系须遵守国家/地区法律。所有争议均受高等法院管辖</p>
            <p>仅限古吉拉特邦。</p>
            <p>15。接受我们的报价</p>
            <p>请签署并返回副本以确认您接受本雇佣合同。</p>
            <p>我们欢迎您，并期待得到您的认可并与您合作。</p>
            <p>此致，</p>
            <p>{应用名称}</p>
            <p>{日期}</p>',


            'da' => '<h3 style="text-align: center;"><strong>Tilslutningsbrev</strong></h3>


            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>

            <p>Emne: Udn&aelig;vnelse til stillingen som {designation}</p>







            <p>K&aelig;re {employee_name}</p>



            <p>Vi er glade for at kunne tilbyde dig stillingen som {designation} hos {app_name} "Virksomheden" p&aring; f&oslash;lgende vilk&aring;r og</p>

            <p>betingelser:</p>


            <p>1. P&aring;begyndelse af ans&aelig;ttelse</p>

            <p>Din ans&aelig;ttelse tr&aelig;der i kraft fra {start_date}</p>



            <p>2. Jobtitel</p>


            <p>Din jobtitel vil v&aelig;re {designation}.</p>



            <p>3. L&oslash;n</p>

            <p>Din l&oslash;n og andre goder vil v&aelig;re som angivet i skema 1, hertil.</p>



            <p>4. Udstationeringssted</p>

            <p>Du vil blive sl&aring;et op p&aring; {branch}. Du kan dog blive bedt om at arbejde p&aring; ethvert forretningssted, som virksomheden har, eller</p>

            <p>senere kan erhverve.</p>


            <p>5. Arbejdstimer</p>

            <p>De normale arbejdsdage er mandag til fredag. Du vil blive forpligtet til at arbejde i de timer, som er n&oslash;dvendige for</p>

            <p>beh&oslash;rig varetagelse af dine pligter over for virksomheden. Den normale arbejdstid er fra {start_time} til {end_time}, og det er du</p>

            <p>forventes at arbejde ikke mindre end {total_hours} timer hver uge, og om n&oslash;dvendigt yderligere timer afh&aelig;ngigt af din</p>

            <p>ansvar.</p>



            <p>6. Orlov/Ferie</p>

            <p>6.1 Du har ret til tilf&aelig;ldig ferie p&aring; 12 dage.</p>

            <p>6.2 Du har ret til 12 arbejdsdages sygefrav&aelig;r med l&oslash;n.</p>

            <p>6.3 Virksomheden skal meddele en liste over erkl&aelig;rede helligdage i begyndelsen af ​​hvert &aring;r.</p>



            <p>7. Arbejdsopgavernes art</p>

            <p>Du vil efter bedste evne udf&oslash;re alle de opgaver, der er iboende i din stilling og s&aring;danne yderligere opgaver som virksomheden</p>

            <p>kan opfordre dig til at optr&aelig;de, fra tid til anden. Dine specifikke pligter er beskrevet i skema II hertil.</p>


            <p>8. Firmaejendom</p>

            <p>Du vil altid vedligeholde virksomhedens ejendom i god stand, som kan blive overdraget til dig til officiel brug i l&oslash;bet af</p>

            <p>din ans&aelig;ttelse, og skal returnere al s&aring;dan ejendom til virksomheden, f&oslash;r du opgiver din afgift, i modsat fald vil omkostningerne</p>

            <p>af samme vil blive inddrevet fra dig af virksomheden.</p>



            <p>9. L&aring;n/modtagelse af gaver</p>

            <p>Du vil ikke l&aring;ne eller acceptere nogen penge, gave, bel&oslash;nning eller kompensation for dine personlige gevinster fra eller p&aring; anden m&aring;de placere dig selv</p>

            <p>under en &oslash;konomisk forpligtelse over for enhver person/kunde, som du m&aring;tte have officielle forbindelser med.</p>

            <p>10. Opsigelse</p>

            <p>10.1 Din ans&aelig;ttelse kan opsiges af virksomheden uden nogen grund ved at give dig mindst [varsel] m&aring;neder f&oslash;r</p>

            <p>skriftligt varsel eller l&oslash;n i stedet herfor. Ved l&oslash;n forst&aring;s i denne paragraf grundl&oslash;n.</p>

            <p>10.2 Du kan opsige dit ans&aelig;ttelsesforhold i virksomheden uden nogen grund ved at give mindst [Medarbejdermeddelelse]</p>

            <p>m&aring;neders forudg&aring;ende varsel eller l&oslash;n for den ikke-opsparede periode, tilbage efter regulering af afventende orlov, som p&aring; dato.</p>

            <p>10.3 Virksomheden forbeholder sig retten til at opsige dit ans&aelig;ttelsesforhold midlertidigt uden opsigelsesfrist eller opsigelsesbetaling</p>

            <p>hvis den har rimelig grund til at tro, at du er skyldig i forseelse eller uagtsomhed, eller har beg&aring;et et grundl&aelig;ggende brud p&aring;</p>

            <p>kontrakt, eller for&aring;rsaget tab for virksomheden.</p>

            <p>10. 4 Ved oph&oslash;r af din ans&aelig;ttelse uanset &aring;rsag, vil du returnere al ejendom til virksomheden; dokumenter, og</p>

            <p>papir, b&aring;de originale og kopier heraf, inklusive pr&oslash;ver, litteratur, kontrakter, optegnelser, lister, tegninger, tegninger,</p>

            <p>breve, notater, data og lignende; og fortrolige oplysninger, i din besiddelse eller under din kontrol vedr&oslash;rende din</p>

            <p>ans&aelig;ttelse eller til kunders forretningsforhold.</p>
            <p>11. Fortrolige oplysninger</p>

            <p>11. 1 Under din ans&aelig;ttelse i virksomheden vil du bruge al din tid, opm&aelig;rksomhed og dygtighed efter bedste evne til</p>

            <p>sin virksomhed. Du m&aring; ikke, direkte eller indirekte, engagere eller associere dig med, v&aelig;re forbundet med, bekymret, ansat eller</p>

            <p>tid eller forf&oslash;lge et hvilket som helst studieforl&oslash;b uden forudg&aring;ende tilladelse fra virksomheden. involveret i anden virksomhed eller</p>

            <p>aktiviteter eller enhver anden stilling eller arbejde p&aring; deltid eller forf&oslash;lge ethvert studieforl&oslash;b uden forudg&aring;ende tilladelse fra</p>

            <p>Selskab.</p>
            <p>11.2 Du skal altid opretholde den h&oslash;jeste grad af fortrolighed og opbevare optegnelser, dokumenter og andre fortrolige oplysninger.</p>

            <p>Fortrolige oplysninger vedr&oslash;rende virksomhedens virksomhed, som kan v&aelig;re kendt af dig eller betroet dig p&aring; nogen m&aring;de</p>

            <p>og du vil kun bruge s&aring;danne optegnelser, dokumenter og oplysninger p&aring; en beh&oslash;rigt autoriseret m&aring;de i virksomhedens interesse. Til</p>

            <p>form&aring;lene med denne paragraf "Fortrolige oplysninger" betyder oplysninger om virksomhedens og dets kunders forretning</p>

            <p>som ikke er tilg&aelig;ngelig for offentligheden, og som du kan l&aelig;re i l&oslash;bet af din ans&aelig;ttelse. Dette inkluderer,</p>

            <p>men er ikke begr&aelig;nset til information vedr&oslash;rende organisationen, dens kundelister, ans&aelig;ttelsespolitikker, personale og information</p>

            <p>om virksomhedens produkter, processer, herunder ideer, koncepter, projektioner, teknologi, manualer, tegning, design,</p>

            <p>specifikationer og alle papirer, CVer, optegnelser og andre dokumenter, der indeholder s&aring;danne fortrolige oplysninger.</p>

            <p>11.3 Du vil p&aring; intet tidspunkt fjerne fortrolige oplysninger fra kontoret uden tilladelse.</p>

            <p>11.4 Din pligt til at beskytte og ikke oplyse</p>

            <p>e Fortrolige oplysninger vil overleve udl&oslash;bet eller opsigelsen af ​​denne aftale og/eller din ans&aelig;ttelse hos virksomheden.</p>

            <p>11.5 Overtr&aelig;delse af betingelserne i denne klausul vil g&oslash;re dig ansvarlig for midlertidig afskedigelse i henhold til klausulen ovenfor ud over evt.</p>

            <p>andre retsmidler, som virksomheden m&aring;tte have mod dig i henhold til loven.</p>
            <p>12. Meddelelser</p>

            <p>Meddelelser kan gives af dig til virksomheden p&aring; dets registrerede kontoradresse. Meddelelser kan gives af virksomheden til dig p&aring;</p>

            <p>den adresse, du har angivet i de officielle optegnelser.</p>



            <p>13. Anvendelse af virksomhedens politik</p>

            <p>Virksomheden er berettiget til fra tid til anden at afgive politiske erkl&aelig;ringer vedr&oslash;rende sager som ret til orlov, barsel</p>

            <p>orlov, ansattes ydelser, arbejdstider, overf&oslash;rselspolitikker osv., og kan &aelig;ndre det samme fra tid til anden efter eget sk&oslash;n.</p>

            <p>Alle s&aring;danne politiske beslutninger fra virksomheden er bindende for dig og tilsides&aelig;tter denne aftale i det omfang.</p>



            <p>14. G&aelig;ldende lov/Jurisdiktion</p>

            <p>Din ans&aelig;ttelse hos virksomheden er underlagt landets love. Alle tvister er underlagt High Courts jurisdiktion</p>

            <p>Kun Gujarat.</p>



            <p>15. Accept af vores tilbud</p>

            <p>Bekr&aelig;ft venligst din accept af denne ans&aelig;ttelseskontrakt ved at underskrive og returnere kopien.</p>



            <p>Vi byder dig velkommen og ser frem til at modtage din accept og til at arbejde sammen med dig.</p>



            <p>Venlig hilsen,</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'de' => '<h3 style="text-align: center;"><strong>Beitrittsbrief</strong></h3>

            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>



            <p>Betreff: Ernennung f&uuml;r die Stelle von {designation}</p>







            <p>Sehr geehrter {employee_name},</p>



            <p>Wir freuen uns, Ihnen die Position von {designation} bei {app_name} dem &bdquo;Unternehmen&ldquo; zu den folgenden Bedingungen anbieten zu k&ouml;nnen</p>

            <p>Bedingungen:</p>


            <p>1. Aufnahme des Arbeitsverh&auml;ltnisses</p>

            <p>Ihre Anstellung gilt ab dem {start_date}</p>


            <p>2. Berufsbezeichnung</p>

            <p>Ihre Berufsbezeichnung lautet {designation}.</p>


            <p>3. Gehalt</p>

            <p>Ihr Gehalt und andere Leistungen sind in Anhang 1 zu diesem Dokument aufgef&uuml;hrt.</p>


            <p>4. Postort</p>

            <p>Sie werden bei {branch} eingestellt. Es kann jedoch erforderlich sein, dass Sie an jedem Gesch&auml;ftssitz arbeiten, den das Unternehmen hat, oder</p>

            <p>sp&auml;ter erwerben kann.</p>


            <p>5. Arbeitszeit</p>
            <p>Die normalen Arbeitstage sind Montag bis Freitag. Sie m&uuml;ssen so viele Stunden arbeiten, wie es f&uuml;r die erforderlich ist</p>
            <p>ordnungsgem&auml;&szlig;e Erf&uuml;llung Ihrer Pflichten gegen&uuml;ber dem Unternehmen. Die normalen Arbeitszeiten sind von {start_time} bis {end_time} und Sie sind es</p>
            <p>voraussichtlich nicht weniger als {total_hours} Stunden pro Woche arbeiten, und falls erforderlich, abh&auml;ngig von Ihren zus&auml;tzlichen Stunden</p>
            <p>Verantwortlichkeiten.</p>



            <p>6. Urlaub/Urlaub</p>

            <p>6.1 Sie haben Anspruch auf Freizeiturlaub von 12 Tagen.</p>

            <p>6.2 Sie haben Anspruch auf 12 Arbeitstage bezahlten Krankenurlaub.</p>

            <p>6.3 Das Unternehmen teilt zu Beginn jedes Jahres eine Liste der erkl&auml;rten Feiertage mit.</p>



            <p>7. Art der Pflichten</p>

            <p>Sie werden alle Aufgaben, die mit Ihrer Funktion verbunden sind, sowie alle zus&auml;tzlichen Aufgaben als Unternehmen nach besten Kr&auml;ften erf&uuml;llen</p>

            <p>kann Sie von Zeit zu Zeit zur Leistung auffordern. Ihre spezifischen Pflichten sind in Anhang II zu diesem Dokument aufgef&uuml;hrt.</p>



            <p>8. Firmeneigentum</p>

            <p>Sie werden das Firmeneigentum, das Ihnen im Laufe der Zeit f&uuml;r offizielle Zwecke anvertraut werden kann, stets in gutem Zustand halten</p>

            <p>Ihrer Anstellung und muss all dieses Eigentum an das Unternehmen zur&uuml;ckgeben, bevor Sie Ihre Geb&uuml;hr aufgeben, andernfalls die Kosten</p>

            <p>derselben werden von der Gesellschaft von Ihnen zur&uuml;ckgefordert.</p>



            <p>9. Leihen/Annehmen von Geschenken</p>

            <p>Sie werden kein Geld, Geschenk, keine Belohnung oder Entsch&auml;digung f&uuml;r Ihre pers&ouml;nlichen Gewinne von sich leihen oder annehmen oder sich anderweitig platzieren</p>

            <p>unter finanzieller Verpflichtung gegen&uuml;ber Personen/Kunden, mit denen Sie m&ouml;glicherweise dienstliche Beziehungen unterhalten.</p>

            <p>10. K&uuml;ndigung</p>

            <p>10.1 Ihre Ernennung kann vom Unternehmen ohne Angabe von Gr&uuml;nden gek&uuml;ndigt werden, indem es Ihnen mindestens [K&uuml;ndigung] Monate im Voraus mitteilt</p>

            <p>schriftliche K&uuml;ndigung oder Gehalt statt dessen. Gehalt im Sinne dieser Klausel bedeutet Grundgehalt.</p>

            <p>10.2 Sie k&ouml;nnen Ihre Anstellung beim Unternehmen ohne Angabe von Gr&uuml;nden k&uuml;ndigen, indem Sie mindestens [Mitarbeitermitteilung]</p>

            <p>K&uuml;ndigungsfrist von Monaten oder Gehalt f&uuml;r den nicht angesparten Zeitraum, der nach Anpassung der anstehenden Urlaubstage &uuml;brig bleibt, zum Stichtag.</p>

            <p>10.3 Das Unternehmen beh&auml;lt sich das Recht vor, Ihr Arbeitsverh&auml;ltnis ohne K&uuml;ndigungsfrist oder Abfindungszahlung fristlos zu k&uuml;ndigen</p>

            <p>wenn es begr&uuml;ndeten Anlass zu der Annahme gibt, dass Sie sich eines Fehlverhaltens oder einer Fahrl&auml;ssigkeit schuldig gemacht haben oder einen wesentlichen Versto&szlig; begangen haben</p>

            <p>oder dem Unternehmen Verluste verursacht haben.</p>

            <p>10. 4 Bei Beendigung Ihres Besch&auml;ftigungsverh&auml;ltnisses, aus welchem ​​Grund auch immer, werden Sie s&auml;mtliches Eigentum an das Unternehmen zur&uuml;ckgeben; Dokumente und</p>

            <p>Papier, sowohl Original als auch Kopien davon, einschlie&szlig;lich aller Muster, Literatur, Vertr&auml;ge, Aufzeichnungen, Listen, Zeichnungen, Blaupausen,</p>

            <p>Briefe, Notizen, Daten und dergleichen; und vertrauliche Informationen, die sich in Ihrem Besitz oder unter Ihrer Kontrolle befinden und sich auf Sie beziehen</p>

            <p>Besch&auml;ftigung oder f&uuml;r die gesch&auml;ftlichen Angelegenheiten der Kunden.</p>

            <p>11. Confidential Information</p>

            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>

            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>

            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>

            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>

            <p>Company.</p>

            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>

            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>

            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>

            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>

            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>

            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>

            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>

            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>

            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>

            <p>11.4 Your duty to safeguard and not disclos</p>

            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>

            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>

            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>

            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>

            <p>the address intimated by you in the official records.</p>



            <p>13. Applicability of Company Policy</p>

            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>

            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>

            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>



            <p>14. Governing Law/Jurisdiction</p>

            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>

            <p>Gujarat only.</p>



            <p>15. Acceptance of our offer</p>

            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>



            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>



            <p>Yours Sincerely,</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'en' => '<h3 style="text-align: center;">Joining Letter</h3>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>Subject: Appointment for the post of {designation}</p>
            <p>Dear {employee_name},</p>
            <p>We are pleased to offer you the position of {designation} with {app_name} theCompany on the following terms and</p>
            <p>conditions:</p>
            <p>1. Commencement of employment</p>
            <p>Your employment will be effective, as of {start_date}</p>
            <p>2. Job title</p>
            <p>Your job title will be{designation}.</p>
            <p>3. Salary</p>
            <p>Your salary and other benefits will be as set out in Schedule 1, hereto.</p>
            <p>4. Place of posting</p>
            <p>You will be posted at {branch}. You may however be required to work at any place of business which the Company has, or</p>
            <p>may later acquire.</p>
            <p>5. Hours of Work</p>
            <p>The normal working days are Monday through Friday. You will be required to work for such hours as necessary for the</p>
            <p>proper discharge of your duties to the Company. The normal working hours are from {start_time} to {end_time} and you are</p>
            <p>expected to work not less than {total_hours} hours each week, and if necessary for additional hours depending on your</p>
            <p>responsibilities.</p>
            <p>6. Leave/Holidays</p>
            <p>6.1 You are entitled to casual leave of 12 days.</p>
            <p>6.2 You are entitled to 12 working days of paid sick leave.</p>
            <p>6.3 The Company shall notify a list of declared holidays at the beginning of each year.</p>
            <p>7. Nature of duties</p>
            <p>You will perform to the best of your ability all the duties as are inherent in your post and such additional duties as the company</p>
            <p>may call upon you to perform, from time to time. Your specific duties are set out in Schedule II hereto.</p>
            <p>8. Company property</p>
            <p>You will always maintain in good condition Company property, which may be entrusted to you for official use during the course of</p>
            <p>your employment, and shall return all such property to the Company prior to relinquishment of your charge, failing which the cost</p>
            <p>of the same will be recovered from you by the Company.</p>
            <p>9. Borrowing/accepting gifts</p>
            <p>You will not borrow or accept any money, gift, reward, or compensation for your personal gains from or otherwise place yourself</p>
            <p>under pecuniary obligation to any person/client with whom you may be having official dealings.</p>
            <p>10. Termination</p>
            <p>10.1 Your appointment can be terminated by the Company, without any reason, by giving you not less than [Notice] months prior</p>
            <p>notice in writing or salary in lieu thereof. For the purpose of this clause, salary shall mean basic salary.</p>
            <p>10.2 You may terminate your employment with the Company, without any cause, by giving no less than [Employee Notice]</p>
            <p>months prior notice or salary for the unsaved period, left after adjustment of pending leaves, as on date.</p>
            <p>10.3 The Company reserves the right to terminate your employment summarily without any notice period or termination payment</p>
            <p>if it has reasonable ground to believe you are guilty of misconduct or negligence, or have committed any fundamental breach of</p>
            <p>contract, or caused any loss to the Company.</p>
            <p>10. 4 On the termination of your employment for whatever reason, you will return to the Company all property; documents, and</p>
            <p>paper, both original and copies thereof, including any samples, literature, contracts, records, lists, drawings, blueprints,</p>
            <p>letters, notes, data and the like; and Confidential Information, in your possession or under your control relating to your</p>
            <p>employment or to clients business affairs.</p>
            <p>11. Confidential Information</p>
            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>
            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>
            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>
            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>
            <p>Company.</p>
            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other</p>
            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>
            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>
            <p>the purposes of this clauseConfidential Information means information about the Companys business and that of its customers</p>
            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>
            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>
            <p>about the Companys products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,</p>
            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>
            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>
            <p>11.4 Your duty to safeguard and not disclos</p>
            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>
            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>
            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>
            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>
            <p>the address intimated by you in the official records.</p>
            <p>13. Applicability of Company Policy</p>
            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>
            <p>leave, employees benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>
            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that extent.</p>
            <p>14. Governing Law/Jurisdiction</p>
            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>
            <p>Gujarat only.</p>
            <p>15. Acceptance of our offer</p>
            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>
            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>
            <p>Yours Sincerely,</p>
            <p>{app_name}</p>
            <p>{date}</p>',

            'es' => '<h3 style="text-align: center;"><strong>Carta de uni&oacute;n</strong></h3>


            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>



            <p>Asunto: Nombramiento para el puesto de {designation}</p>



            <p>Estimado {employee_name},</p>

            <p>Nos complace ofrecerle el puesto de {designation} con {app_name}, la Compa&ntilde;&iacute;a en los siguientes t&eacute;rminos y</p>

            <p>condiciones:</p>


            <p>1. Comienzo del empleo</p>

            <p>Su empleo ser&aacute; efectivo a partir del {start_date}</p>


            <p>2. T&iacute;tulo del trabajo</p>
            <p>El t&iacute;tulo de su trabajo ser&aacute; {designation}.</p>

            <p>3. Salario</p>

            <p>Su salario y otros beneficios ser&aacute;n los establecidos en el Anexo 1 del presente.</p>


            <p>4. Lugar de destino</p>
            <p>Se le publicar&aacute; en {branch}. Sin embargo, es posible que deba trabajar en cualquier lugar de negocios que tenga la Compa&ntilde;&iacute;a, o</p>

            <p>puede adquirir posteriormente.</p>



            <p>5. Horas de trabajo</p>

            <p>Los d&iacute;as normales de trabajo son de lunes a viernes. Se le pedir&aacute; que trabaje las horas que sean necesarias para el</p>

            <p>cumplimiento adecuado de sus deberes para con la Compa&ntilde;&iacute;a. El horario normal de trabajo es de {start_time} a {end_time} y usted est&aacute;</p>

            <p>se espera que trabaje no menos de {total_hours} horas cada semana y, si es necesario, horas adicionales dependiendo de su</p>

            <p>responsabilidades.</p>



            <p>6. Licencia/Vacaciones</p>

            <p>6.1 Tiene derecho a un permiso eventual de 12 d&iacute;as.</p>

            <p>6.2 Tiene derecho a 12 d&iacute;as laborables de baja por enfermedad remunerada.</p>

            <p>6.3 La Compa&ntilde;&iacute;a deber&aacute; notificar una lista de d&iacute;as festivos declarados al comienzo de cada a&ntilde;o.</p>



            <p>7. Naturaleza de los deberes</p>

            <p>Desempe&ntilde;ar&aacute; lo mejor que pueda todas las funciones inherentes a su puesto y aquellas funciones adicionales que la empresa</p>

            <p>puede pedirte que act&uacute;es, de vez en cuando. Sus deberes espec&iacute;ficos se establecen en el Anexo II del presente.</p>



            <p>8. Propiedad de la empresa</p>

            <p>Siempre mantendr&aacute; en buenas condiciones la propiedad de la Compa&ntilde;&iacute;a, que se le puede confiar para uso oficial durante el curso de</p>

            <p>su empleo, y devolver&aacute; todos esos bienes a la Compa&ntilde;&iacute;a antes de renunciar a su cargo, en caso contrario, el costo</p>

            <p>de la misma ser&aacute; recuperada de usted por la Compa&ntilde;&iacute;a.</p>



            <p>9. Tomar prestado/aceptar regalos</p>

            <p>No pedir&aacute; prestado ni aceptar&aacute; dinero, obsequios, recompensas o compensaciones por sus ganancias personales o se colocar&aacute; de otra manera</p>

            <p>bajo obligaci&oacute;n pecuniaria a cualquier persona/cliente con quien pueda tener tratos oficiales.</p>
            <p>10. Terminaci&oacute;n</p>

            <p>10.1 Su nombramiento puede ser rescindido por la Compa&ntilde;&iacute;a, sin ning&uacute;n motivo, al darle no menos de [Aviso] meses antes</p>

            <p>aviso por escrito o salario en su lugar. Para los efectos de esta cl&aacute;usula, se entender&aacute; por salario el salario base.</p>

            <p>10.2 Puede rescindir su empleo con la Compa&ntilde;&iacute;a, sin ninguna causa, dando no menos de [Aviso al empleado]</p>

            <p>meses de preaviso o salario por el per&iacute;odo no ahorrado, remanente despu&eacute;s del ajuste de licencias pendientes, a la fecha.</p>

            <p>10.3 La Compa&ntilde;&iacute;a se reserva el derecho de rescindir su empleo sumariamente sin ning&uacute;n per&iacute;odo de preaviso o pago por rescisi&oacute;n</p>

            <p>si tiene motivos razonables para creer que usted es culpable de mala conducta o negligencia, o ha cometido una violaci&oacute;n fundamental de</p>

            <p>contrato, o causado cualquier p&eacute;rdida a la Compa&ntilde;&iacute;a.</p>

            <p>10. 4 A la terminaci&oacute;n de su empleo por cualquier motivo, devolver&aacute; a la Compa&ntilde;&iacute;a todos los bienes; documentos, y</p>

            <p>papel, tanto en original como en copia del mismo, incluyendo cualquier muestra, literatura, contratos, registros, listas, dibujos, planos,</p>

            <p>cartas, notas, datos y similares; e Informaci&oacute;n confidencial, en su posesi&oacute;n o bajo su control en relaci&oacute;n con su</p>

            <p>empleo o a los asuntos comerciales de los clientes.</p>
            <p>11. Informaci&oacute;n confidencial</p>

            <p>11. 1 Durante su empleo en la Compa&ntilde;&iacute;a, dedicar&aacute; todo su tiempo, atenci&oacute;n y habilidad lo mejor que pueda para</p>

            <p>son negocios. Usted no deber&aacute;, directa o indirectamente, comprometerse o asociarse con, estar conectado, interesado, empleado o</p>

            <p>tiempo o seguir cualquier curso de estudio, sin el permiso previo de la Compa&ntilde;&iacute;a. participar en cualquier otro negocio o</p>

            <p>actividades o cualquier otro puesto o trabajo a tiempo parcial o seguir cualquier curso de estudio, sin el permiso previo de la</p>

            <p>Compa&ntilde;&iacute;a.</p>

            <p>11.2 Siempre debe mantener el m&aacute;s alto grado de confidencialidad y mantener como confidenciales los registros, documentos y otros</p>

            <p>Informaci&oacute;n confidencial relacionada con el negocio de la Compa&ntilde;&iacute;a que usted pueda conocer o confiarle por cualquier medio</p>

            <p>y utilizar&aacute; dichos registros, documentos e informaci&oacute;n solo de manera debidamente autorizada en inter&eacute;s de la Compa&ntilde;&iacute;a. Para</p>

            <p>A los efectos de esta cl&aacute;usula, "Informaci&oacute;n confidencial" significa informaci&oacute;n sobre el negocio de la Compa&ntilde;&iacute;a y el de sus clientes.</p>

            <p>que no est&aacute; disponible para el p&uacute;blico en general y que usted puede aprender en el curso de su empleo. Esto incluye,</p>

            <p>pero no se limita a, informaci&oacute;n relacionada con la organizaci&oacute;n, sus listas de clientes, pol&iacute;ticas de empleo, personal e informaci&oacute;n</p>

            <p>sobre los productos de la Compa&ntilde;&iacute;a, procesos que incluyen ideas, conceptos, proyecciones, tecnolog&iacute;a, manuales, dibujos, dise&ntilde;os,</p>

            <p>especificaciones, y todos los papeles, curr&iacute;culos, registros y otros documentos que contengan dicha Informaci&oacute;n Confidencial.</p>

            <p>11.3 En ning&uacute;n momento, sacar&aacute; ninguna Informaci&oacute;n Confidencial de la oficina sin permiso.</p>

            <p>11.4 Su deber de salvaguardar y no divulgar</p>

            <p>La Informaci&oacute;n Confidencial sobrevivir&aacute; a la expiraci&oacute;n o terminaci&oacute;n de este Acuerdo y/o su empleo con la Compa&ntilde;&iacute;a.</p>

            <p>11.5 El incumplimiento de las condiciones de esta cl&aacute;usula le har&aacute; pasible de despido sumario en virtud de la cl&aacute;usula anterior adem&aacute;s de cualquier</p>

            <p>otro recurso que la Compa&ntilde;&iacute;a pueda tener contra usted por ley.</p>
            <p>12. Avisos</p>

            <p>Usted puede enviar notificaciones a la Compa&ntilde;&iacute;a a su domicilio social. La Compa&ntilde;&iacute;a puede enviarle notificaciones a usted en</p>

            <p>la direcci&oacute;n indicada por usted en los registros oficiales.</p>



            <p>13. Aplicabilidad de la pol&iacute;tica de la empresa</p>

            <p>La Compa&ntilde;&iacute;a tendr&aacute; derecho a hacer declaraciones de pol&iacute;tica de vez en cuando relacionadas con asuntos como el derecho a licencia, maternidad</p>

            <p>licencia, beneficios de los empleados, horas de trabajo, pol&iacute;ticas de transferencia, etc., y puede modificarlas de vez en cuando a su sola discreci&oacute;n.</p>

            <p>Todas las decisiones pol&iacute;ticas de la Compa&ntilde;&iacute;a ser&aacute;n vinculantes para usted y anular&aacute;n este Acuerdo en esa medida.</p>



            <p>14. Ley aplicable/Jurisdicci&oacute;n</p>

            <p>Su empleo con la Compa&ntilde;&iacute;a est&aacute; sujeto a las leyes del Pa&iacute;s. Todas las disputas estar&aacute;n sujetas a la jurisdicci&oacute;n del Tribunal Superior</p>

            <p>S&oacute;lo Gujarat.</p>



            <p>15. Aceptaci&oacute;n de nuestra oferta</p>

            <p>Por favor, confirme su aceptaci&oacute;n de este Contrato de Empleo firmando y devolviendo el duplicado.</p>



            <p>Le damos la bienvenida y esperamos recibir su aceptaci&oacute;n y trabajar con usted.</p>



            <p>Tuyo sinceramente,</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'fr' => '<h3 style="text-align: center;">Lettre dadh&eacute;sion</h3>


            <p>{date}</p>

            <p>{employee_name}</p>
            <p>{address}</p>


            <p>Objet : Nomination pour le poste de {designation}</p>



            <p>Cher {employee_name},</p>


            <p>Nous sommes heureux de vous proposer le poste de {designation} avec {app_name} la "Soci&eacute;t&eacute;" selon les conditions suivantes et</p>

            <p>les conditions:</p>

            <p>1. Entr&eacute;e en fonction</p>

            <p>Votre emploi sera effectif &agrave; partir du {start_date}</p>



            <p>2. Intitul&eacute; du poste</p>

            <p>Votre titre de poste sera {designation}.</p>



            <p>3. Salaire</p>

            <p>Votre salaire et vos autres avantages seront tels quindiqu&eacute;s &agrave; lannexe 1 ci-jointe.</p>


            <p>4. Lieu de d&eacute;tachement</p>
            <p>Vous serez affect&eacute; &agrave; {branch}. Vous pouvez cependant &ecirc;tre tenu de travailler dans nimporte quel lieu daffaires que la Soci&eacute;t&eacute; a, ou</p>

            <p>pourra acqu&eacute;rir plus tard.</p>



            <p>5. Heures de travail</p>

            <p>Les jours ouvrables normaux sont du lundi au vendredi. Vous devrez travailler les heures n&eacute;cessaires &agrave; la</p>

            <p>lexercice correct de vos fonctions envers la Soci&eacute;t&eacute;. Les heures normales de travail vont de {start_time} &agrave; {end_time} et vous &ecirc;tes</p>

            <p>devrait travailler au moins {total_hours} heures par semaine, et si n&eacute;cessaire des heures suppl&eacute;mentaires en fonction de votre</p>

            <p>responsabilit&eacute;s.</p>

            <p>6. Cong&eacute;s/Vacances</p>

            <p>6.1 Vous avez droit &agrave; un cong&eacute; occasionnel de 12 jours.</p>

            <p>6.2 Vous avez droit &agrave; 12 jours ouvrables de cong&eacute; de maladie pay&eacute;.</p>

            <p>6.3 La Soci&eacute;t&eacute; communiquera une liste des jours f&eacute;ri&eacute;s d&eacute;clar&eacute;s au d&eacute;but de chaque ann&eacute;e.</p>



            <p>7. Nature des fonctions</p>

            <p>Vous ex&eacute;cuterez au mieux de vos capacit&eacute;s toutes les t&acirc;ches inh&eacute;rentes &agrave; votre poste et les t&acirc;ches suppl&eacute;mentaires que lentreprise</p>

            <p>peut faire appel &agrave; vous pour effectuer, de temps &agrave; autre. Vos fonctions sp&eacute;cifiques sont &eacute;nonc&eacute;es &agrave; lannexe II ci-jointe.</p>



            <p>8. Biens sociaux</p>

            <p>Vous maintiendrez toujours en bon &eacute;tat les biens de la Soci&eacute;t&eacute;, qui peuvent vous &ecirc;tre confi&eacute;s pour un usage officiel au cours de votre</p>

            <p>votre emploi, et doit restituer tous ces biens &agrave; la Soci&eacute;t&eacute; avant labandon de votre charge, &agrave; d&eacute;faut de quoi le co&ucirc;t</p>

            <p>de m&ecirc;me seront r&eacute;cup&eacute;r&eacute;s aupr&egrave;s de vous par la Soci&eacute;t&eacute;.</p>



            <p>9. Emprunter/accepter des cadeaux</p>

            <p>Vous nemprunterez ni naccepterez dargent, de cadeau, de r&eacute;compense ou de compensation pour vos gains personnels ou vous placerez autrement</p>

            <p>sous obligation p&eacute;cuniaire envers toute personne/client avec qui vous pourriez avoir des relations officielles.</p>
            <p>10. R&eacute;siliation</p>

            <p>10.1 Votre nomination peut &ecirc;tre r&eacute;sili&eacute;e par la Soci&eacute;t&eacute;, sans aucune raison, en vous donnant au moins [Pr&eacute;avis] mois avant</p>

            <p>un pr&eacute;avis &eacute;crit ou un salaire en tenant lieu. Aux fins de la pr&eacute;sente clause, salaire sentend du salaire de base.</p>

            <p>10.2 Vous pouvez r&eacute;silier votre emploi au sein de la Soci&eacute;t&eacute;, sans motif, en donnant au moins [Avis &agrave; lemploy&eacute;]</p>

            <p>mois de pr&eacute;avis ou de salaire pour la p&eacute;riode non &eacute;pargn&eacute;e, restant apr&egrave;s r&eacute;gularisation des cong&eacute;s en attente, &agrave; la date.</p>

            <p>10.3 La Soci&eacute;t&eacute; se r&eacute;serve le droit de r&eacute;silier votre emploi sans pr&eacute;avis ni indemnit&eacute; de licenciement.</p>

            <p>sil a des motifs raisonnables de croire que vous &ecirc;tes coupable dinconduite ou de n&eacute;gligence, ou que vous avez commis une violation fondamentale de</p>

            <p>contrat, ou caus&eacute; une perte &agrave; la Soci&eacute;t&eacute;.</p>

            <p>10. 4 &Agrave; la fin de votre emploi pour quelque raison que ce soit, vous restituerez &agrave; la Soci&eacute;t&eacute; tous les biens ; document, et</p>

            <p>papier, &agrave; la fois loriginal et les copies de celui-ci, y compris les &eacute;chantillons, la litt&eacute;rature, les contrats, les dossiers, les listes, les dessins, les plans,</p>

            <p>lettres, notes, donn&eacute;es et similaires; et Informations confidentielles, en votre possession ou sous votre contr&ocirc;le relatives &agrave; votre</p>

            <p>lemploi ou aux affaires commerciales des clients.</p>
            <p>11. Informations confidentielles</p>

            <p>11. 1 Au cours de votre emploi au sein de la Soci&eacute;t&eacute;, vous consacrerez tout votre temps, votre attention et vos comp&eacute;tences au mieux de vos capacit&eacute;s pour</p>

            <p>son affaire. Vous ne devez pas, directement ou indirectement, vous engager ou vous associer &agrave;, &ecirc;tre li&eacute; &agrave;, concern&eacute;, employ&eacute; ou</p>

            <p>temps ou poursuivre quelque programme d&eacute;tudes que ce soit, sans lautorisation pr&eacute;alable de la Soci&eacute;t&eacute;. engag&eacute; dans toute autre entreprise ou</p>

            <p>activit&eacute;s ou tout autre poste ou travail &agrave; temps partiel ou poursuivre des &eacute;tudes quelconques, sans lautorisation pr&eacute;alable du</p>

            <p>Compagnie.</p>

            <p>11.2 Vous devez toujours maintenir le plus haut degr&eacute; de confidentialit&eacute; et garder confidentiels les dossiers, documents et autres</p>

            <p>Informations confidentielles relatives &agrave; lactivit&eacute; de la Soci&eacute;t&eacute; dont vous pourriez avoir connaissance ou qui vous seraient confi&eacute;es par tout moyen</p>

            <p>et vous nutiliserez ces registres, documents et informations que dune mani&egrave;re d&ucirc;ment autoris&eacute;e dans lint&eacute;r&ecirc;t de la Soci&eacute;t&eacute;. Pour</p>

            <p>aux fins de la pr&eacute;sente clause &laquo; Informations confidentielles &raquo; d&eacute;signe les informations sur les activit&eacute;s de la Soci&eacute;t&eacute; et celles de ses clients</p>

            <p>qui nest pas accessible au grand public et dont vous pourriez avoir connaissance dans le cadre de votre emploi. Ceci comprend,</p>

            <p>mais sans sy limiter, les informations relatives &agrave; lorganisation, ses listes de clients, ses politiques demploi, son personnel et les informations</p>

            <p>sur les produits, les processus de la Soci&eacute;t&eacute;, y compris les id&eacute;es, les concepts, les projections, la technologie, les manuels, les dessins, les conceptions,</p>

            <p>sp&eacute;cifications, et tous les papiers, curriculum vitae, dossiers et autres documents contenant de telles informations confidentielles.</p>

            <p>11.3 &Agrave; aucun moment, vous ne retirerez des informations confidentielles du bureau sans autorisation.</p>

            <p>11.4 Votre devoir de prot&eacute;ger et de ne pas divulguer</p>

            <p>Les Informations confidentielles survivront &agrave; lexpiration ou &agrave; la r&eacute;siliation du pr&eacute;sent Contrat et/ou &agrave; votre emploi au sein de la Soci&eacute;t&eacute;.</p>

            <p>11.5 La violation des conditions de cette clause vous rendra passible dun renvoi sans pr&eacute;avis en vertu de la clause ci-dessus en plus de tout</p>

            <p>autre recours que la Soci&eacute;t&eacute; peut avoir contre vous en droit.</p>
            <p>12. Avis</p>

            <p>Des avis peuvent &ecirc;tre donn&eacute;s par vous &agrave; la Soci&eacute;t&eacute; &agrave; ladresse de son si&egrave;ge social. Des avis peuvent vous &ecirc;tre donn&eacute;s par la Soci&eacute;t&eacute; &agrave;</p>

            <p>ladresse que vous avez indiqu&eacute;e dans les registres officiels.</p>



            <p>13. Applicabilit&eacute; de la politique de lentreprise</p>

            <p>La Soci&eacute;t&eacute; est autoris&eacute;e &agrave; faire des d&eacute;clarations de politique de temps &agrave; autre concernant des questions telles que le droit aux cong&eacute;s, la maternit&eacute;</p>

            <p>les cong&eacute;s, les avantages sociaux des employ&eacute;s, les heures de travail, les politiques de transfert, etc., et peut les modifier de temps &agrave; autre &agrave; sa seule discr&eacute;tion.</p>

            <p>Toutes ces d&eacute;cisions politiques de la Soci&eacute;t&eacute; vous lieront et pr&eacute;vaudront sur le pr&eacute;sent Contrat dans cette mesure.</p>



            <p>14. Droit applicable/juridiction</p>

            <p>Votre emploi au sein de la Soci&eacute;t&eacute; est soumis aux lois du pays. Tous les litiges seront soumis &agrave; la comp&eacute;tence du tribunal de grande instance</p>

            <p>Gujarat uniquement.</p>



            <p>15. Acceptation de notre offre</p>

            <p>Veuillez confirmer votre acceptation de ce contrat de travail en signant et en renvoyant le duplicata.</p>



            <p>Nous vous souhaitons la bienvenue et nous nous r&eacute;jouissons de recevoir votre acceptation et de travailler avec vous.</p>



            <p>Cordialement,</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'he' =>'<h3 style="text-align: center;">מכתב הצטרפות</h3>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>נושא: מינוי לתפקיד של {designation}</p>
            <p>{employee_name} היקר,</p>
            <p>אנו שמחים להציע לך את התפקיד של {designation} ב-{app_name} theCompany בתנאים הבאים ו</p>
            <p>תנאים:</p>
            <p>1. תחילת עבודה</p>
            <p>העסקה שלך תיכנס לתוקף, החל מ-{start_date}</p>
            <p>2. כותרת תפקיד</p>
            <p>כותרת המשרה שלך תהיה {designation}.</p>
            <p>3. משכורת</p>
            <p>השכר וההטבות האחרות שלך יהיו כמפורט בתוספת 1, להלן.</p>
            <p>4. מקום הפרסום</p>
            <p>תפרסם ב-{branch}. עם זאת, ייתכן שתידרש לעבוד בכל מקום עסק שיש לחברה, או</p>
            <p>עשוי מאוחר יותר לרכוש.</p>
            <p>5. שעות עבודה</p>
            <p>ימי העבודה הרגילים הם שני עד שישי. תידרש לעבוד במשך שעות הדרושות ל</p>
            <p>מילוי נאות של חובותיך כלפי החברה. שעות העבודה הרגילות הן מ-{start_time} עד {end_time} ואתה</p>
            <p>צפוי לעבוד לא פחות מ-{total_hours} שעות בכל שבוע, ובמידת הצורך לשעות נוספות בהתאם ל</p>
            <p>אחריות.</p>
            <p>6. עזוב/חגים</p>
            <p>6.1 אתה זכאי לחופשה מזדמנת של 12 ימים.</p>
            <p>6.2 אתה זכאי ל-12 ימי עבודה של חופשת מחלה בתשלום.</p>
            <p>6.3 החברה תודיע על רשימה של חגים מוכרזים בתחילת כל שנה.</p>
            <p>7. אופי התפקידים</p>
            <p>תבצע כמיטב יכולתך את כל החובות הגלומות בתפקידך וחובות נוספות כמו החברה</p>
            <p>עשוי לקרוא לך להופיע, מעת לעת. החובות הספציפיות שלך מפורטות בנספח II להלן.</p>
            <p>8. נכס החברה</p>
            <p>תמיד תשמור על רכוש החברה במצב טוב, אשר עשוי להיות מופקד בידיך לשימוש רשמי במהלך</p>
            <p>העסקתך, ותחזיר את כל הרכוש כאמור לחברה לפני ויתור על החיוב שלך, אם לא העלות</p>
            <p>של אותו החברה יגבה ממך.</p>
            <p>9. השאלת/קבלת מתנות</p>
            <p>לא תלווה או תקבל שום כסף, מתנה, תגמול או פיצוי עבור הרווחים האישיים שלך מעצמך או למקם את עצמך בדרך אחרת</p>
            <p>תחת התחייבות כספית לכל אדם/לקוח שעמו אתה מקיים עסקאות רשמיות.</p>
            <p>10. סיום</p>
            <p>10.1 החברה יכולה לסיים את המינוי שלך, ללא כל סיבה, על ידי מתן הודעה לא פחות מ[הודעה] חודשים לפני</p>
            <p>הודעה בכתב או שכר במקום. לעניין סעיף זה, שכר פירושו שכר יסוד.</p>
            <p>10.2 אתה רשאי לסיים את העסקתך בחברה, ללא כל סיבה, על ידי מתן לא פחות מ[הודעת עובד]</p>
            <p>הודעה מוקדמת של חודשים או משכורת לתקופה שלא נשמרה, שנותרה לאחר התאמה של חופשות ממתינות, כמו בתאריך.</p>
            <p>10.3 החברה שומרת לעצמה את הזכות לסיים את העסקתך באופן סופי ללא כל תקופת הודעה מוקדמת או תשלום פיטורין</p>
            <p>אם יש לו יסוד סביר להאמין שאתה אשם בהתנהגות בלתי הולמת או ברשלנות, או שביצעת הפרה יסודית כלשהי של</p>
            <p>חוזה, או גרם להפסד כלשהו לחברה.</p>
            <p>10. 4 עם סיום העסקתך מכל סיבה שהיא, תחזיר לחברה את כל הרכוש; מסמכים ו</p>
            <p>נייר, הן במקור והן בהעתקים שלו, כולל כל דוגמאות, ספרות, חוזים, רשומות, רשימות, שרטוטים, שרטוטים,</p>
            <p>מכתבים, הערות, נתונים וכדומה; ומידע סודי, ברשותך או בשליטתך, הקשור ל</p> שלך
            <p>תעסוקה או עניינים עסקיים ללקוחות.</p>
            <p>11. מידע סודי</p>
            <p>11. 1 במהלך עבודתך בחברה תקדיש את כל זמנך, תשומת הלב והמיומנות שלך כמיטב יכולתך ל</p>
            <p>העסק שלה. לא, במישרין או בעקיפין, לא תתקשר או תקשר את עצמך, תהיה קשור, מודאג, מועסק, או</p>
            <p>זמן או להמשיך כל מסלול לימודים שהוא, ללא אישור מראש של החברה. עוסק בכל עסק אחר או</p>
            <p>פעילויות או כל משרה אחרת או עבודה במשרה חלקית או להמשיך בכל מסלול לימודים שהוא, ללא אישור מראש של</p>
            <p>חברה.</p>
            <p>11.2 עליך לשמור תמיד על רמת הסודיות הגבוהה ביותר ולשמור בסודיות את הרשומות, המסמכים ואחרים</p>
            <p>מידע סודי המתייחס לעסקים של החברה שעשוי להיות ידוע לך או נסוב לך בכל אמצעי</p>
            <p>ותשתמש ברשומות, במסמכים ובמידע כאמור רק באופן מורשה כדין לטובת החברה. עבור</p>
            <p>מטרות סעיף זה מידע סודי פירושה מידע על עסקי החברה ושל לקוחותיה</p>
            <p>אשר אינו זמין לציבור הרחב ואשר עשוי ללמוד על ידך במהלך העסקתך. זה כולל,</p>
            <p>אך לא מוגבל למידע הנוגע לארגון, רשימות הלקוחות שלו, מדיניות העסקה, כוח אדם ומידע</p>
            <p>על מוצרי החברה, תהליכים, כולל רעיונות, מושגים, תחזיות, טכנולוגיה, מדריכים, שרטוט, עיצובים,</p>
            <p>מפרטים וכל הניירות, קורות החיים, הרשומות ומסמכים אחרים המכילים מידע סודי כזה.</p>
            <p>11.3 בשום זמן לא תסיר כל מידע סודי מהמשרד ללא רשות.</p>
            <p>11.4 חובתך לשמור ולא לחשוף</p>
            <p>המידע הסודי ישרוד את תפוגה או סיומו של הסכם זה ו/או העסקתך בחברה.</p>
            <p>11.5 הפרת התנאים של סעיף זה תגרום לך לחייב אותך לפיטורים על הסף על פי הסעיף לעיל בנוסף לכל</p>
            <p>סעד אחר שעשויה להיות לחברה נגדך בחוק.</p>
            <p>12. הודעות</p>
            <p>ייתכן שתמסרו הודעות לחברה בכתובת המשרד הרשום שלה. ייתכן שהחברה תמסור לך הודעות בכתובת</p>
            <p>הכתובת שציינת ברשומות הרשמיות.</p>
            <p>13. תחולת מדיניות החברה</p>
            <p>החברה תהיה רשאית להצהיר מעת לעת הצהרות מדיניות הנוגעות לעניינים כמו זכאות לחופשה, לידה</p>
            <p>עזיבה, הטבות לעובדים, שעות עבודה, מדיניות העברה וכו, ועשויות לשנות את אותם מעת לעת לפי שיקול דעתה הבלעדי.</p>
            <p>כל החלטות המדיניות הללו של החברה יחייבו אותך ויעקפו את הסכם זה במידה זו.</p>
            <p>14. חוק חל/תחום שיפוט</p>
            <p>העסקתך בחברה כפופה לחוקי המדינה. כל המחלוקות יהיו כפופות לסמכות השיפוט של בית המשפט העליון</p>
            <p>גוג אראט בלבד.</p>
            <p>15. קבלת ההצעה שלנו</p>
            <p>אנא אשר את הסכמתך לחוזה העסקה זה על ידי חתימה והחזרת העותק הכפול.</p>
            <p>אנו מברכים אותך ומצפים לקבל את הסכמתך ולעבוד איתך.</p>
            <p>בכבוד רב,</p>
            <p>{app_name}</p>

            <p>{date}</p>',


            'it' => '<h3 style="text-align: center;">Lettera di adesione</h3>


            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>

            <p>Oggetto: Appuntamento alla carica di {designation}</p>


            <p>Gentile {employee_name},</p>

            <p>Siamo lieti di offrirti la posizione di {designation} con {app_name} la "Societ&agrave;" alle seguenti condizioni e</p>

            <p>condizioni:</p>


            <p>1. Inizio del rapporto di lavoro</p>

            <p>Il tuo impiego sar&agrave; effettivo a partire da {start_date}</p>



            <p>2. Titolo di lavoro</p>

            <p>Il tuo titolo di lavoro sar&agrave; {designation}.</p>

            <p>3. Stipendio</p>

            <p>Il tuo stipendio e altri benefici saranno come indicato nellAllegato 1, qui di seguito.</p>



            <p>4. Luogo di invio</p>

            <p>Sarai inviato a {branch}. Tuttavia, potrebbe essere richiesto di lavorare in qualsiasi luogo di attivit&agrave; che la Societ&agrave; ha, o</p>

            <p>potr&agrave; successivamente acquisire.</p>



            <p>5. Orario di lavoro</p>

            <p>I normali giorni lavorativi sono dal luned&igrave; al venerd&igrave;. Ti verr&agrave; richiesto di lavorare per le ore necessarie per il</p>

            <p>corretto adempimento dei propri doveri nei confronti della Societ&agrave;. Lorario di lavoro normale va da {start_time} a {end_time} e tu lo sei</p>

            <p>dovrebbe lavorare non meno di {total_hours} ore ogni settimana e, se necessario, per ore aggiuntive a seconda del tuo</p>

            <p>responsabilit&agrave;.</p>



            <p>6. Permessi/Festivit&agrave;</p>

            <p>6.1 Hai diritto a un congedo occasionale di 12 giorni.</p>

            <p>6.2 Hai diritto a 12 giorni lavorativi di congedo per malattia retribuito.</p>

            <p>6.3 La Societ&agrave; comunica allinizio di ogni anno un elenco delle festivit&agrave; dichiarate.</p>



            <p>7. Natura degli incarichi</p>

            <p>Eseguirai al meglio delle tue capacit&agrave; tutti i compiti inerenti al tuo incarico e compiti aggiuntivi come lazienda</p>

            <p>pu&ograve; invitarti a esibirti, di tanto in tanto. I tuoi doveri specifici sono stabiliti nellAllegato II del presente documento.</p>



            <p>8. Propriet&agrave; aziendale</p>

            <p>Manterrete sempre in buono stato i beni dellAzienda, che nel corso dellanno potrebbero esservi affidati per uso ufficiale</p>

            <p>il tuo impiego, e restituir&agrave; tutte queste propriet&agrave; alla Societ&agrave; prima della rinuncia al tuo addebito, in caso contrario il costo</p>

            <p>degli stessi saranno da voi recuperati dalla Societ&agrave;.</p>



            <p>9. Prendere in prestito/accettare regali</p>

            <p>Non prenderai in prestito n&eacute; accetterai denaro, dono, ricompensa o compenso per i tuoi guadagni personali da o altrimenti collocato te stesso</p>

            <p>sotto obbligazione pecuniaria nei confronti di qualsiasi persona/cliente con cui potresti avere rapporti ufficiali.</p>
            <p>10. Cessazione</p>

            <p>10.1 Il tuo incarico pu&ograve; essere risolto dalla Societ&agrave;, senza alcun motivo, dandoti non meno di [Avviso] mesi prima</p>

            <p>avviso scritto o stipendio in sostituzione di esso. Ai fini della presente clausola, per stipendio si intende lo stipendio base.</p>

            <p>10.2 &Egrave; possibile terminare il proprio rapporto di lavoro con la Societ&agrave;, senza alcuna causa, fornendo non meno di [Avviso per il dipendente]</p>

            <p>mesi di preavviso o stipendio per il periodo non risparmiato, lasciato dopo ladeguamento delle ferie pendenti, come alla data.</p>

            <p>10.3 La Societ&agrave; si riserva il diritto di terminare il rapporto di lavoro sommariamente senza alcun periodo di preavviso o pagamento di cessazione</p>

            <p>se ha fondati motivi per ritenere che tu sia colpevole di cattiva condotta o negligenza, o abbia commesso una violazione fondamentale</p>

            <p>contratto, o ha causato danni alla Societ&agrave;.</p>

            <p>10. 4 Alla cessazione del rapporto di lavoro per qualsiasi motivo, restituirete alla Societ&agrave; tutti i beni; documenti, e</p>

            <p>carta, sia in originale che in copia, inclusi eventuali campioni, letteratura, contratti, registrazioni, elenchi, disegni, progetti,</p>

            <p>lettere, note, dati e simili; e Informazioni Riservate, in tuo possesso o sotto il tuo controllo, relative alla tua</p>

            <p>lavoro o agli affari dei clienti.</p>
            <p>11. Confidential Information</p>

            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>

            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>

            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>

            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>

            <p>Company.</p>

            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>

            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>

            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>

            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>

            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>

            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>

            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>

            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>

            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>

            <p>11.4 Your duty to safeguard and not disclos</p>

            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>

            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>

            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>

            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>

            <p>the address intimated by you in the official records.</p>



            <p>13. Applicability of Company Policy</p>

            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>

            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>

            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>



            <p>14. Governing Law/Jurisdiction</p>

            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>

            <p>Gujarat only.</p>



            <p>15. Acceptance of our offer</p>

            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>



            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>



            <p>Yours Sincerely,</p>

            <p>{app_name}</p>

            <p>{date}</p>
            ',
            'ja' => '<h3 style="text-align: center;">入会の手紙</h3>

            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>



            <p>件名: {designation} の役職への任命</p>



            <p>{employee_name} 様</p>


            <p>{app_name} の {designation} の地位を以下の条件で「会社」として提供できることをうれしく思います。</p>

            <p>条件：</p>


            <p>1. 雇用開始</p>

            <p>あなたの雇用は {start_date} から有効になります</p>


            <p>2. 役職</p>

            <p>あなたの役職は{designation}になります。</p>


            <p>3. 給与</p>

            <p>あなたの給与およびその他の福利厚生は、本明細書のスケジュール 1 に記載されているとおりです。</p>


            <p>4. 掲示場所</p>

            <p>{branch} に掲載されます。ただし、会社が所有する事業所で働く必要がある場合があります。</p>

            <p>後で取得する場合があります。</p>



            <p>5. 労働時間</p>

            <p>通常の営業日は月曜日から金曜日です。あなたは、そのために必要な時間働く必要があります。</p>

            <p>会社に対するあなたの義務の適切な遂行。通常の勤務時間は {start_time} から {end_time} までで、あなたは</p>

            <p>毎週 {total_hours} 時間以上の勤務が期待される</p>

            <p>責任。</p>



            <p>6.休暇・休日</p>

            <p>6.1 12 日間の臨時休暇を取得する権利があります。</p>

            <p>6.2 12 日間の有給病気休暇を取る権利があります。</p>

            <p>6.3 当社は、毎年の初めに宣言された休日のリストを通知するものとします。</p>



            <p>7. 職務内容</p>

            <p>あなたは、自分のポストに固有のすべての義務と、会社としての追加の義務を最大限に遂行します。</p>

            <p>時々あなたに演奏を依頼するかもしれません。あなたの特定の義務は、本明細書のスケジュール II に記載されています。</p>



            <p>8. 会社財産</p>

            <p>あなたは、会社の所有物を常に良好な状態に維持するものとします。</p>

            <p>あなたの雇用を放棄し、あなたの料金を放棄する前に、そのようなすべての財産を会社に返還するものとします。</p>

            <p>同じのは、会社によってあなたから回収されます。</p>



            <p>9. 貸出・贈答品の受け取り</p>

            <p>あなたは、あなた自身から、または他の方法であなた自身の場所から個人的な利益を得るための金銭、贈り物、報酬、または補償を借りたり、受け取ったりしません。</p>

            <p>あなたが公式の取引をしている可能性のある人物/クライアントに対する金銭的義務の下で。</p>
            <p>10. 終了</p>

            <p>10.1 少なくとも [通知] か月前に通知することにより、理由のいかんを問わず、会社はあなたの任命を終了することができます。</p>

            <p>書面による通知またはその代わりの給与。この条項の目的上、給与とは基本給を意味するものとします。</p>

            <p>10.2 あなたは、少なくとも [従業員通知] を提出することにより、理由のいかんを問わず、会社での雇用を終了することができます。</p>

            <p>保留中の休暇の調整後に残された、保存されていない期間の数か月前の通知または給与は、日付のとおりです。</p>

            <p>10.3 当社は、通知期間や解雇補償金なしに、あなたの雇用を即座に終了させる権利を留保します。</p>

            <p>あなたが不正行為または過失で有罪であると信じる合理的な根拠がある場合、または基本的な違反を犯した場合</p>

            <p>契約、または当社に損害を与えた。</p>

            <p>10. 4 何らかの理由で雇用が終了した場合、あなたは会社にすべての財産を返還するものとします。ドキュメント、および</p>

            <p>サンプル、文献、契約書、記録、リスト、図面、青写真を含む、原本とコピーの両方の紙、</p>

            <p>手紙、メモ、データなど。あなたが所有する、またはあなたの管理下にある機密情報。</p>

            <p>雇用またはクライアントの業務に。</p>
            <p>11. 機密情報</p>

            <p>11. 1 当社での雇用期間中、あなたは自分の全時間、注意、およびスキルを、自分の能力の限りを尽くして捧げます。</p>

            <p>そのビジネス。あなたは、直接的または間接的に、関与したり、関連付けたり、接続したり、関係したり、雇用したり、または</p>

            <p>会社の事前の許可なしに、時間や学習コースを追求すること。他のビジネスに従事すること、または</p>

            <p>の事前の許可なしに、活動またはその他の投稿またはアルバイトをしたり、何らかの研究コースを追求したりすること。</p>

            <p>会社。</p>

            <p>11.2 常に最高度の機密性を維持し、記録、文書、およびその他の情報を機密として保持する必要があります。</p>

            <p>お客様が知っている、または何らかの方法でお客様に内密にされている可能性がある、当社の事業に関連する機密情報</p>

            <p>また、あなたは、会社の利益のために正当に承認された方法でのみ、そのような記録、文書、および情報を使用するものとします。為に</p>

            <p>この条項の目的 「機密情報」とは、会社の事業および顧客の事業に関する情報を意味します。</p>

            <p>これは一般には公開されておらず、雇用の過程で学習する可能性があります。これも、</p>

            <p>組織、その顧客リスト、雇用方針、人事、および情報に関連する情報に限定されません</p>

            <p>当社の製品、アイデアを含むプロセス、コンセプト、予測、技術、マニュアル、図面、デザイン、</p>

            <p>仕様、およびそのような機密情報を含むすべての書類、履歴書、記録、およびその他の文書。</p>

            <p>11.3 いかなる時も、許可なくオフィスから機密情報を削除しないでください。</p>

            <p>11.4 保護し、開示しないというあなたの義務</p>

            <p>e 機密情報は、本契約および/または当社との雇用の満了または終了後も存続します。</p>

            <p>11.5 この条項の条件に違反した場合、上記の条項に基づく略式解雇の対象となります。</p>

            <p>会社が法律であなたに対して持つことができるその他の救済。</p>
            <p>12. 通知</p>

            <p>通知は、登録された事務所の住所で会社に提出することができます。通知は、当社からお客様に提供される場合があります。</p>

            <p>公式記録であなたがほのめかした住所。</p>



            <p>13. 会社方針の適用性</p>

            <p>会社は、休暇の資格、出産などの事項に関して、随時方針を宣言する権利を有するものとします。</p>

            <p>休暇、従業員の福利厚生、勤務時間、異動ポリシーなどであり、独自の裁量により随時変更される場合があります。</p>

            <p>当社のそのようなポリシー決定はすべて、あなたを拘束し、その範囲で本契約を無効にするものとします。</p>



            <p>14. 準拠法・裁判管轄</p>

            <p>当社でのあなたの雇用は、国の法律の対象となります。すべての紛争は、高等裁判所の管轄に服するものとします</p>

            <p>グジャラートのみ。</p>



            <p>15. オファーの受諾</p>

            <p>副本に署名して返送することにより、この雇用契約に同意したことを確認してください。</p>



            <p>私たちはあなたを歓迎し、あなたの受け入れを受け取り、あなたと一緒に働くことを楽しみにしています.</p>



            <p>敬具、</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'nl' => '<h3 style="text-align: center;">Deelnemende brief</h3>

            <p>{date}</p>

            <p>{employee}</p>

            <p>{address}</p>

            <p>Onderwerp: Benoeming voor de functie van {designation}</p>

            <p>Beste {employee_name},</p>

            <p>We zijn verheugd u de positie van {designation} bij {app_name} het Bedrijf aan te bieden onder de volgende voorwaarden en</p>

            <p>conditie:</p>


            <p>1. Indiensttreding</p>
            <p>Uw dienstverband gaat in op {start_date}</p>


            <p>2. Functietitel</p>

            <p>Uw functietitel wordt {designation}.</p>

            <p>3. Salaris</p>

            <p>Uw salaris en andere voordelen zijn zoals uiteengezet in Schema 1 hierbij.</p>

            <p>4. Plaats van detachering</p>

            <p>Je wordt geplaatst op {branch}. Het kan echter zijn dat u moet werken op een bedrijfslocatie die het Bedrijf heeft, of</p>

            <p>later kan verwerven.</p>



            <p>5. Werkuren</p>

            <p>De normale werkdagen zijn van maandag tot en met vrijdag. Je zal de uren moeten werken die nodig zijn voor de</p>

            <p>correcte uitvoering van uw taken jegens het bedrijf. De normale werkuren zijn van {start_time} tot {end_time} en jij bent</p>

            <p>naar verwachting niet minder dan {total_hours} uur per week werken, en indien nodig voor extra uren, afhankelijk van uw</p>

            <p>verantwoordelijkheden.</p>



            <p>6. Verlof/Vakantie</p>

            <p>6.1 Je hebt recht op tijdelijk verlof van 12 dagen.</p>

            <p>6.2 U heeft recht op 12 werkdagen betaald ziekteverlof.</p>

            <p>6.3 De Maatschappij stelt aan het begin van elk jaar een lijst van verklaarde feestdagen op.</p>



            <p>7. Aard van de taken</p>

            <p>Je voert alle taken die inherent zijn aan je functie en bijkomende taken zoals het bedrijf naar beste vermogen uit;</p>

            <p>kan van tijd tot tijd een beroep op u doen om op te treden. Uw specifieke taken zijn uiteengezet in Bijlage II hierbij.</p>



            <p>8. Bedrijfseigendommen</p>

            <p>U onderhoudt bedrijfseigendommen, die u in de loop van</p>

            <p>uw dienstverband, en zal al deze eigendommen aan het Bedrijf teruggeven voordat afstand wordt gedaan van uw kosten, bij gebreke waarvan de kosten</p>

            <p>hiervan zal door het Bedrijf van u worden verhaald.</p>



            <p>9. Geschenken lenen/aannemen</p>

            <p>U zult geen geld, geschenken, beloningen of vergoedingen voor uw persoonlijk gewin lenen of accepteren van uzelf of uzelf op een andere manier plaatsen</p>

            <p>onder geldelijke verplichting jegens een persoon/klant met wie u mogelijk offici&euml;le betrekkingen heeft.</p>
            <p>10. Be&euml;indiging</p>

            <p>10.1 Uw aanstelling kan door het Bedrijf zonder opgaaf van reden worden be&euml;indigd door u minimaal [Opzegging] maanden van tevoren</p>

            <p>schriftelijke opzegging of daarvoor in de plaats komend salaris. In dit artikel wordt onder salaris verstaan ​​het basissalaris.</p>

            <p>10.2 U kunt uw dienstverband bij het Bedrijf be&euml;indigen, zonder enige reden, door niet minder dan [Mededeling van de werknemer]</p>

            <p>maanden opzegtermijn of salaris voor de niet gespaarde periode, overgebleven na aanpassing van hangende verlofdagen, zoals op datum.</p>

            <p>10.3 Het bedrijf behoudt zich het recht voor om uw dienstverband op staande voet te be&euml;indigen zonder enige opzegtermijn of be&euml;indigingsvergoeding</p>

            <p>als het redelijke grond heeft om aan te nemen dat u zich schuldig heeft gemaakt aan wangedrag of nalatigheid, of een fundamentele schending van</p>

            <p>contract, of enig verlies voor het Bedrijf veroorzaakt.</p>

            <p>10. 4 Bij be&euml;indiging van uw dienstverband om welke reden dan ook, geeft u alle eigendommen terug aan het Bedrijf; documenten, en</p>

            <p>papier, zowel origineel als kopie&euml;n daarvan, inclusief eventuele monsters, literatuur, contracten, bescheiden, lijsten, tekeningen, blauwdrukken,</p>

            <p>brieven, notities, gegevens en dergelijke; en Vertrouwelijke informatie, in uw bezit of onder uw controle met betrekking tot uw</p>

            <p>werkgelegenheid of de zakelijke aangelegenheden van klanten.</p>
            <p>11. Vertrouwelijke informatie</p>

            <p>11. 1 Tijdens uw dienstverband bij het Bedrijf besteedt u al uw tijd, aandacht en vaardigheden naar uw beste vermogen aan:</p>

            <p>zijn zaken. U mag zich niet, direct of indirect, inlaten met of verbonden zijn met, betrokken zijn bij, betrokken zijn bij, in dienst zijn van of</p>

            <p>tijd doorbrengen of een studie volgen, zonder voorafgaande toestemming van het bedrijf.bezig met een ander bedrijf of</p>

            <p>werkzaamheden of enige andere functie of werk in deeltijd of het volgen van welke opleiding dan ook, zonder voorafgaande toestemming van de</p>

            <p>Bedrijf.</p>

            <p>11.2 U moet altijd de hoogste graad van vertrouwelijkheid handhaven en de records, documenten en andere</p>

            <p>Vertrouwelijke informatie met betrekking tot het bedrijf van het bedrijf die u op enigerlei wijze bekend is of in vertrouwen is genomen</p>

            <p>en u zult dergelijke records, documenten en informatie alleen gebruiken op een naar behoren gemachtigde manier in het belang van het bedrijf. Voor</p>

            <p>de doeleinden van deze clausule Vertrouwelijke informatiebetekent informatie over het bedrijf van het bedrijf en dat van zijn klanten</p>

            <p>die niet beschikbaar is voor het grote publiek en die u tijdens uw dienstverband kunt leren. Dit bevat,</p>

            <p>maar is niet beperkt tot informatie met betrekking tot de organisatie, haar klantenlijsten, werkgelegenheidsbeleid, personeel en informatie</p>

            <p>over de producten, processen van het bedrijf, inclusief idee&euml;n, concepten, projecties, technologie, handleidingen, tekeningen, ontwerpen,</p>

            <p>specificaties, en alle papieren, cvs, dossiers en andere documenten die dergelijke vertrouwelijke informatie bevatten.</p>

            <p>11.3 U verwijdert nooit vertrouwelijke informatie van het kantoor zonder toestemming.</p>

            <p>11.4 Uw plicht om te beschermen en niet openbaar te maken</p>

            <p>e Vertrouwelijke informatie blijft van kracht na het verstrijken of be&euml;indigen van deze Overeenkomst en/of uw dienstverband bij het Bedrijf.</p>

            <p>11.5 Schending van de voorwaarden van deze clausule maakt u aansprakelijk voor ontslag op staande voet op grond van de bovenstaande clausule, naast eventuele:</p>

            <p>ander rechtsmiddel dat het Bedrijf volgens de wet tegen u heeft.</p>
            <p>12. Kennisgevingen</p>

            <p>Kennisgevingen kunnen door u aan het Bedrijf worden gedaan op het adres van de maatschappelijke zetel. Kennisgevingen kunnen door het bedrijf aan u worden gedaan op:</p>

            <p>het door u opgegeven adres in de offici&euml;le administratie.</p>



            <p>13. Toepasselijkheid van het bedrijfsbeleid</p>

            <p>Het bedrijf heeft het recht om van tijd tot tijd beleidsverklaringen af ​​te leggen met betrekking tot zaken als verlofrecht, moederschap</p>

            <p>verlof, werknemersvoordelen, werkuren, transferbeleid, enz., en kan deze van tijd tot tijd naar eigen goeddunken wijzigen.</p>

            <p>Al dergelijke beleidsbeslissingen van het Bedrijf zijn bindend voor u en hebben voorrang op deze Overeenkomst in die mate.</p>



            <p>14. Toepasselijk recht/jurisdictie</p>

            <p>Uw dienstverband bij het bedrijf is onderworpen aan de landelijke wetgeving. Alle geschillen zijn onderworpen aan de jurisdictie van de High Court</p>

            <p>Alleen Gujarat.</p>



            <p>15. Aanvaarding van ons aanbod</p>

            <p>Bevestig uw aanvaarding van deze arbeidsovereenkomst door het duplicaat te ondertekenen en terug te sturen.</p>



            <p>Wij heten u van harte welkom en kijken ernaar uit uw acceptatie te ontvangen en met u samen te werken.</p>



            <p>Hoogachtend,</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'pl' => '<h3 style="text-align: center;">Dołączanie listu</h3>

            <p>{date }</p>

            <p>{employee_name }</p>

            <p>{address }</p>


            <p>Dotyczy: mianowania na stanowisko {designation}</p>

            <p>Szanowny {employee_name },</p>

            <p>Mamy przyjemność zaoferować Państwu, stanowisko {designation} z {app_name } "Sp&oacute;łka" na poniższych warunkach i</p>
            <p>warunki:</p>

            <p>1. Rozpoczęcie pracy</p>

            <p>Twoje zatrudnienie będzie skuteczne, jak na {start_date }</p>

            <p>2. Tytuł zadania</p>
            <p>Tw&oacute;j tytuł pracy to {designation}.</p>

            <p>3. Salary</p>

            <p>Twoje wynagrodzenie i inne świadczenia będą określone w Zestawieniu 1, do niniejszego rozporządzenia.</p>


            <p>4. Miejsce delegowania</p>
            <p>Użytkownik zostanie opublikowany w {branch }. Użytkownik może jednak być zobowiązany do pracy w dowolnym miejscu prowadzenia działalności, kt&oacute;re Sp&oacute;łka posiada, lub może p&oacute;źniej nabyć.</p>

            <p>5. Godziny pracy</p>
            <p>Normalne dni robocze są od poniedziałku do piątku. Będziesz zobowiązany do pracy na takie godziny, jakie są niezbędne do prawidłowego wywiązania się ze swoich obowiązk&oacute;w wobec Sp&oacute;łki. Normalne godziny pracy to {start_time } do {end_time }, a użytkownik oczekuje, że będzie pracować nie mniej niż {total_hours } godzin tygodniowo, a jeśli to konieczne, przez dodatkowe godziny w zależności od Twojego</p>
            <p>odpowiedzialności.</p>

            <p>6. Urlop/Wakacje</p>

            <p>6.1 Przysługuje prawo do urlopu dorywczego w ciągu 12 dni.</p>

            <p>6.2 Użytkownik ma prawo do 12 dni roboczych od wypłatnego zwolnienia chorobowego.</p>

            <p>6.3 Sp&oacute;łka powiadamia na początku każdego roku wykaz ogłoszonych świąt.&nbsp;</p>



            <p>7. Rodzaj obowiązk&oacute;w</p>

            <p>Będziesz wykonywać na najlepsze ze swojej zdolności wszystkie obowiązki, jak są one nieodłączne w swoim poście i takie dodatkowe obowiązki, jak firma może zadzwonić do wykonania, od czasu do czasu. Państwa szczeg&oacute;lne obowiązki są określone w załączniku II do niniejszego rozporządzenia.</p>



            <p>8. Właściwość przedsiębiorstwa</p>

            <p>Zawsze będziesz utrzymywać w dobrej kondycji Firmy, kt&oacute;ra może być powierzona do użytku służbowego w trakcie trwania</p>

            <p>Twoje zatrudnienie, i zwr&oacute;ci wszystkie takie nieruchomości do Sp&oacute;łki przed zrzeczeniem się opłaty, w przeciwnym razie koszty te same będą odzyskane od Ciebie przez Sp&oacute;łkę.</p>

            <p>9. Wypożyczanie/akceptowanie prezent&oacute;w</p>

            <p>Nie będziesz pożyczał ani nie akceptować żadnych pieniędzy, dar&oacute;w, nagrody lub odszkodowania za swoje osobiste zyski z lub w inny spos&oacute;b złożyć się w ramach zobowiązania pieniężnego do jakiejkolwiek osoby/klienta, z kt&oacute;rym może być posiadanie oficjalne relacje.</p>
            <p>10. Zakończenie</p>

            <p>10.1 Powołanie może zostać wypowiedziane przez Sp&oacute;łkę, bez względu na przyczynę, poprzez podanie nie mniej niż [ Zawiadomienie] miesięcy uprzedniego wypowiedzenia na piśmie lub wynagrodzenia w miejsce jego wystąpienia. Dla cel&oacute;w niniejszej klauzuli, wynagrodzenie oznacza wynagrodzenie podstawowe.</p>

            <p>10.2 Użytkownik może rozwiązać umowę o pracę ze Sp&oacute;łką, bez jakiejkolwiek przyczyny, podając nie mniej niż [ ogłoszenie o pracowniku] miesiące przed powiadomieniem lub wynagrodzeniem za niezaoszczędzony okres, pozostawiony po skorygowaniu oczekujących liści, jak na dzień.</p>

            <p>10.3 Sp&oacute;łka zastrzega sobie prawo do wypowiedzenia umowy o pracę bez okresu wypowiedzenia lub wypłaty z tytułu rozwiązania umowy, jeżeli ma on uzasadnione podstawy, aby sądzić, że jesteś winny wykroczenia lub niedbalstwa, lub popełnił jakiekolwiek istotne naruszenie umowy lub spowodował jakiekolwiek straty w Sp&oacute;łce.&nbsp;</p>

            <p>10. 4 W sprawie rozwiązania stosunku pracy z jakiegokolwiek powodu, powr&oacute;cisz do Sp&oacute;łki wszystkie nieruchomości; dokumenty, i&nbsp;</p>

            <p>papieru, zar&oacute;wno oryginału, jak i jego kopii, w tym wszelkich pr&oacute;bek, literatury, um&oacute;w, zapis&oacute;w, wykaz&oacute;w, rysunk&oacute;w, konspekt&oacute;w,</p>

            <p>listy, notatki, dane i podobne; informacje poufne, znajdujące się w posiadaniu lub pod Twoją kontrolą związane z zatrudnieniem lub sprawami biznesowymi klient&oacute;w.&nbsp; &nbsp;</p>



            <p>11. Informacje poufne</p>

            <p>11. 1 Podczas swojego zatrudnienia z Firmą poświęcisz cały czas, uwagę i umiejętności na najlepszą z Twoich możliwości</p>

            <p>swojej działalności gospodarczej. Użytkownik nie może, bezpośrednio lub pośrednio, prowadzić lub wiązać się z, być związany z, dotyka, zatrudniony lub czas lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody Company.zaangażował się w innej działalności gospodarczej lub działalności lub jakikolwiek inny post lub pracy w niepełnym wymiarze czasu lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody</p>

            <p>Firma.</p>

            <p>11.2 Zawsze musisz zachować najwyższy stopień poufności i zachować jako poufny akt, dokumenty, i inne&nbsp;</p>

            <p>Informacje poufne dotyczące działalności Sp&oacute;łki, kt&oacute;re mogą być znane Państwu lub w dowolny spos&oacute;b zwierzyny, a Użytkownik będzie posługiwać się takimi zapisami, dokumentami i informacjami tylko w spos&oacute;b należycie autoryzowany w interesie Sp&oacute;łki. Do cel&oacute;w niniejszej klauzuli "Informacje poufne" oznaczają informacje o działalności Sp&oacute;łki oraz o jej klientach, kt&oacute;re nie są dostępne dla og&oacute;łu społeczeństwa i kt&oacute;re mogą być przez Państwa w trakcie zatrudnienia dowiedzione przez Państwa. Obejmuje to,</p>

            <p>ale nie ogranicza się do informacji związanych z organizacją, jej listami klient&oacute;w, politykami zatrudnienia, personelem oraz informacjami o produktach firmy, procesach, w tym pomysłach, koncepcjach, projekcjach, technikach, podręcznikach, rysunkach, projektach,&nbsp;</p>

            <p>specyfikacje, a także wszystkie dokumenty, życiorysy, zapisy i inne dokumenty zawierające takie informacje poufne.</p>

            <p>11.3 W żadnym momencie nie usunie Pan żadnych Informacji Poufnych z urzędu bez zezwolenia.</p>

            <p>11.4 Tw&oacute;j obowiązek ochrony a nie disclos</p>

            <p>Informacje poufne przetrwają wygaśnięcie lub rozwiązanie niniejszej Umowy i/lub Twoje zatrudnienie w Sp&oacute;łce.</p>

            <p>11.5 Naruszenie warunk&oacute;w niniejszej klauzuli spowoduje, że Użytkownik będzie zobowiązany do skr&oacute;conej umowy w ramach klauzuli powyżej, opr&oacute;cz wszelkich innych środk&oacute;w zaradcze, jakie Sp&oacute;łka może mieć przeciwko Państwu w prawie.</p>



            <p>12. Uwagi</p>

            <p>Ogłoszenia mogą być podane przez Państwa do Sp&oacute;łki pod adresem jej siedziby. Ogłoszenia mogą być podane przez Sp&oacute;łkę do Państwa na adres intymniony przez Państwa w ewidencji urzędowej.</p>



            <p>13. Stosowność polityki firmy</p>

            <p>Sp&oacute;łka jest uprawniona do składania deklaracji politycznych od czasu do czasu dotyczących spraw takich jak prawo do urlopu macierzyńskiego, macierzyństwo</p>

            <p>urlop&oacute;w, świadczeń pracowniczych, godzin pracy, polityki transferowej itp., a także mogą zmieniać to samo od czasu do czasu według własnego uznania.</p>

            <p>Wszystkie takie decyzje polityczne Sp&oacute;łki są wiążące dla Państwa i przesłaniają niniejszą Umowę w tym zakresie.</p>



            <p>14. Prawo właściwe/jurysdykcja</p>

            <p>Twoje zatrudnienie ze Sp&oacute;łką podlega prawu krajowi. Wszelkie spory podlegają właściwości Sądu Najwyższego</p>

            <p>Tylko Gujarat.</p>



            <p>15. Akceptacja naszej oferty</p>

            <p>Prosimy o potwierdzenie przyjęcia niniejszej Umowy o pracę poprzez podpisanie i zwr&oacute;cenie duplikatu.</p>



            <p>Zapraszamy Państwa i czekamy na Państwa przyjęcie i wsp&oacute;łpracę z Tobą.</p>



            <p>Z Państwa Sincerely,</p>

            <p>{app_name }</p>

            <p>{date }</p>',


            'pt' => '<h3 style="text-align: center;">Carta De Ades&atilde;o</h3>

            <p>{data}</p>

            <p>{employee_name}</p>

            <p>{address}</p>


            <p>Assunto: Nomea&ccedil;&atilde;o para o cargo de {designation}</p>

            <p>Querido {employee_name},</p>


            <p>Temos o prazer de oferec&ecirc;-lo, a posi&ccedil;&atilde;o de {designation} com {app_name} a Empresa nos seguintes termos e</p>
            <p>condi&ccedil;&otilde;es:</p>


            <p>1. Comentamento do emprego</p>

            <p>Seu emprego ser&aacute; efetivo, a partir de {start_date}</p>


            <p>2. T&iacute;tulo do emprego</p>

            <p>Seu cargo de trabalho ser&aacute; {designation}.</p>

            <p>3. Sal&aacute;rio</p>

            <p>Seu sal&aacute;rio e outros benef&iacute;cios ser&atilde;o conforme estabelecido no Planejamento 1, hereto.</p>

            <p>4. Local de postagem</p>

            <p>Voc&ecirc; ser&aacute; postado em {branch}. Voc&ecirc; pode, no entanto, ser obrigado a trabalhar em qualquer local de neg&oacute;cios que a Empresa tenha, ou possa posteriormente adquirir.</p>

            <p>5. Horas de Trabalho</p>

            <p>Os dias normais de trabalho s&atilde;o de segunda a sexta-feira. Voc&ecirc; ser&aacute; obrigado a trabalhar por tais horas, conforme necess&aacute;rio para a quita&ccedil;&atilde;o adequada de suas fun&ccedil;&otilde;es para a Companhia. As horas de trabalho normais s&atilde;o de {start_time} para {end_time} e voc&ecirc; deve trabalhar n&atilde;o menos de {total_horas} horas semanais, e se necess&aacute;rio para horas adicionais dependendo do seu</p>
            <p>responsabilidades.</p>

            <p>6. Leave / Holidays</p>

            <p>6,1 Voc&ecirc; tem direito a licen&ccedil;a casual de 12 dias.</p>

            <p>6,2 Voc&ecirc; tem direito a 12 dias &uacute;teis de licen&ccedil;a remunerada remunerada.</p>

            <p>6,3 Companhia notificar&aacute; uma lista de feriados declarados no in&iacute;cio de cada ano.&nbsp;</p>



            <p>7. Natureza dos deveres</p>

            <p>Voc&ecirc; ir&aacute; executar ao melhor da sua habilidade todos os deveres como s&atilde;o inerentes ao seu cargo e tais deveres adicionais como a empresa pode ligar sobre voc&ecirc; para executar, de tempos em tempos. Os seus deveres espec&iacute;ficos s&atilde;o estabelecidos no Hereto do Planejamento II.</p>



            <p>8. Propriedade da empresa</p>

            <p>Voc&ecirc; sempre manter&aacute; em bom estado propriedade Empresa, que poder&aacute; ser confiada a voc&ecirc; para uso oficial durante o curso de</p>

            <p>o seu emprego, e devolver&aacute; toda essa propriedade &agrave; Companhia antes de abdicar de sua acusa&ccedil;&atilde;o, falhando qual o custo do mesmo ser&aacute; recuperado de voc&ecirc; pela Companhia.</p>



            <p>9. Borremir / aceitar presentes</p>

            <p>Voc&ecirc; n&atilde;o vai pedir empr&eacute;stimo ou aceitar qualquer dinheiro, presente, recompensa ou indeniza&ccedil;&atilde;o por seus ganhos pessoais de ou de outra forma colocar-se sob obriga&ccedil;&atilde;o pecuni&aacute;ria a qualquer pessoa / cliente com quem voc&ecirc; pode estar tendo rela&ccedil;&otilde;es oficiais.</p>



            <p>10. Termina&ccedil;&atilde;o</p>

            <p>10,1 Sua nomea&ccedil;&atilde;o pode ser rescindida pela Companhia, sem qualquer raz&atilde;o, dando-lhe n&atilde;o menos do que [aviso] meses de aviso pr&eacute;vio por escrito ou de sal&aacute;rio em lieu deste. Para efeito da presente cl&aacute;usula, o sal&aacute;rio deve significar sal&aacute;rio base.</p>

            <p>10,2 Voc&ecirc; pode rescindir seu emprego com a Companhia, sem qualquer causa, ao dar nada menos que [Aviso de contrata&ccedil;&atilde;o] meses de aviso pr&eacute;vio ou sal&aacute;rio para o per&iacute;odo n&atilde;o salvo, deixado ap&oacute;s ajuste de folhas pendentes, conforme data de encontro.</p>

            <p>10,3 Empresa reserva-se o direito de rescindir o seu emprego sumariamente sem qualquer prazo de aviso ou de rescis&atilde;o se tiver terreno razo&aacute;vel para acreditar que voc&ecirc; &eacute; culpado de m&aacute; conduta ou neglig&ecirc;ncia, ou tenha cometido qualquer viola&ccedil;&atilde;o fundamental de contrato, ou tenha causado qualquer perda para a Empresa.&nbsp;</p>

            <p>10. 4 Sobre a rescis&atilde;o do seu emprego por qualquer motivo, voc&ecirc; retornar&aacute; para a Empresa todos os bens; documentos e&nbsp;</p>

            <p>papel, tanto originais como c&oacute;pias dos mesmos, incluindo quaisquer amostras, literatura, contratos, registros, listas, desenhos, plantas,</p>

            <p>cartas, notas, dados e semelhantes; e Informa&ccedil;&otilde;es Confidenciais, em sua posse ou sob seu controle relacionado ao seu emprego ou aos neg&oacute;cios de neg&oacute;cios dos clientes.&nbsp; &nbsp;</p>



            <p>11. Informa&ccedil;&otilde;es Confidenciais</p>

            <p>11. 1 Durante o seu emprego com a Companhia voc&ecirc; ir&aacute; dedicar todo o seu tempo, aten&ccedil;&atilde;o e habilidade para o melhor de sua capacidade de</p>

            <p>o seu neg&oacute;cio. Voc&ecirc; n&atilde;o deve, direta ou indiretamente, se envolver ou associar-se com, estar conectado com, preocupado, empregado, ou tempo ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do Company.engajado em qualquer outro neg&oacute;cio ou atividades ou qualquer outro cargo ou trabalho parcial ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do</p>

            <p>Empresa.</p>

            <p>11,2 &Eacute; preciso manter sempre o mais alto grau de confidencialidade e manter como confidenciais os registros, documentos e outros&nbsp;</p>

            <p>Informa&ccedil;&otilde;es confidenciais relativas ao neg&oacute;cio da Companhia que possam ser conhecidas por voc&ecirc; ou confiadas em voc&ecirc; por qualquer meio e utilizar&atilde;o tais registros, documentos e informa&ccedil;&otilde;es apenas de forma devidamente autorizada no interesse da Companhia. Para efeitos da presente cl&aacute;usula "Informa&ccedil;&otilde;es confidenciais" significa informa&ccedil;&atilde;o sobre os neg&oacute;cios da Companhia e a dos seus clientes que n&atilde;o est&aacute; dispon&iacute;vel para o p&uacute;blico em geral e que poder&aacute; ser aprendida por voc&ecirc; no curso do seu emprego. Isso inclui,</p>

            <p>mas n&atilde;o se limita a, informa&ccedil;&otilde;es relativas &agrave; organiza&ccedil;&atilde;o, suas listas de clientes, pol&iacute;ticas de emprego, pessoal, e informa&ccedil;&otilde;es sobre os produtos da Companhia, processos incluindo ideias, conceitos, proje&ccedil;&otilde;es, tecnologia, manuais, desenho, desenhos,&nbsp;</p>

            <p>especifica&ccedil;&otilde;es, e todos os pap&eacute;is, curr&iacute;culos, registros e outros documentos que contenham tais Informa&ccedil;&otilde;es Confidenciais.</p>

            <p>11,3 Em nenhum momento, voc&ecirc; remover&aacute; quaisquer Informa&ccedil;&otilde;es Confidenciais do escrit&oacute;rio sem permiss&atilde;o.</p>

            <p>11,4 O seu dever de salvaguardar e n&atilde;o os desclos</p>

            <p>Informa&ccedil;&otilde;es Confidenciais sobreviver&atilde;o &agrave; expira&ccedil;&atilde;o ou &agrave; rescis&atilde;o deste Contrato e / ou do seu emprego com a Companhia.</p>

            <p>11,5 Viola&ccedil;&atilde;o das condi&ccedil;&otilde;es desta cl&aacute;usula ir&aacute; torn&aacute;-lo sujeito a demiss&atilde;o sum&aacute;ria sob a cl&aacute;usula acima, al&eacute;m de qualquer outro rem&eacute;dio que a Companhia possa ter contra voc&ecirc; em lei.</p>



            <p>12. Notices</p>

            <p>Os avisos podem ser conferidos por voc&ecirc; &agrave; Empresa em seu endere&ccedil;o de escrit&oacute;rio registrado. Os avisos podem ser conferidos pela Companhia a voc&ecirc; no endere&ccedil;o intimado por voc&ecirc; nos registros oficiais.</p>



            <p>13. Aplicabilidade da Pol&iacute;tica da Empresa</p>

            <p>A Companhia tem direito a fazer declara&ccedil;&otilde;es de pol&iacute;tica de tempos em tempos relativos a mat&eacute;rias como licen&ccedil;a de licen&ccedil;a, maternidade</p>

            <p>sair, benef&iacute;cios dos empregados, horas de trabalho, pol&iacute;ticas de transfer&ecirc;ncia, etc., e pode alterar o mesmo de vez em quando a seu exclusivo crit&eacute;rio.</p>

            <p>Todas essas decis&otilde;es de pol&iacute;tica da Companhia devem ser vinculativas para si e substituir&atilde;o este Acordo nessa medida.</p>



            <p>14. Direito / Jurisdi&ccedil;&atilde;o</p>

            <p>Seu emprego com a Companhia est&aacute; sujeito &agrave;s leis do Pa&iacute;s. Todas as disputas est&atilde;o sujeitas &agrave; jurisdi&ccedil;&atilde;o do Tribunal Superior</p>

            <p>Gujarat apenas.</p>



            <p>15. Aceita&ccedil;&atilde;o da nossa oferta</p>

            <p>Por favor, confirme sua aceita&ccedil;&atilde;o deste Contrato de Emprego assinando e retornando a c&oacute;pia duplicada.</p>



            <p>N&oacute;s acolhemos voc&ecirc; e estamos ansiosos para receber sua aceita&ccedil;&atilde;o e para trabalhar com voc&ecirc;.</p>



            <p>Seu Sinceramente,</p>

            <p>{app_name}</p>

            <p>{data}</p>',


            'ru' => '<h3 style="text-align: center;">Присоединение к письму</h3>

            <p>{date}</p>

            <p>{ employee_name }</p>
            <p>{address}</p>

            <p>Тема: Назначение на должность {designation}</p>

            <p>Уважаемый { employee_name },</p>

            <p>Мы рады предложить Вам, позицию {designation} с { app_name } Компания на следующих условиях и</p>

            <p>условия:</p>


            <p>1. Начало работы</p>

            <p>Ваше трудоустройство будет эффективным, начиная с { start_date }</p>


            <p>2. Название должности</p>
            <p>Ваш заголовок задания будет {designation}.</p>

            <p>3. Зарплата</p>
            <p>Ваши оклады и другие пособия будут установлены в соответствии с расписанием, изложенным в приложении 1 к настоящему.</p>

            <p>4. Место размещения</p>
            <p>Вы будете работать в { branch }. Вы, однако, можете работать в любом месте, которое компания имеет или может впоследствии приобрести.</p>



            <p>5. Часы работы</p>
            <p>Обычные рабочие дни-с понедельника по пятницу. Вы должны будете работать в течение таких часов, как это необходимо для надлежащего выполнения Ваших обязанностей перед компанией. Обычные рабочие часы-от { start_time } до { end_time }, и вы, как ожидается, будут работать не менее { total_hours } часов каждую неделю, и при необходимости в течение дополнительных часов в зависимости от вашего</p>
            <p>ответственности.</p>
            <p>6. Отпуск/Праздники</p>

            <p>6.1 Вы имеете право на случайный отпуск продолжительностью 12 дней.</p>

            <p>6.2 Вы имеете право на 12 рабочих дней оплачиваемого отпуска по болезни.</p>

            <p>6.3 Компания в начале каждого года уведомляет об объявленных праздниках.&nbsp;</p>



            <p>7. Характер обязанностей</p>

            <p>Вы будете выполнять все обязанности, присующие вам, и такие дополнительные обязанности, которые компания может призвать к вам, время от времени. Ваши конкретные обязанности изложены в приложении II к настоящему.</p>



            <p>8. Свойство компании</p>

            <p>Вы всегда будете поддерживать в хорошем состоянии имущество Компании, которое может быть доверено Вам для служебного пользования в течение</p>

            <p>вашей занятости, и возвратит все это имущество Компании до отказа от вашего заряда, при отсутствии которого стоимость одного и того же имущества будет взыскана с Вас компанией.</p>



            <p>9. Боровить/принять подарки</p>

            <p>Вы не будете брать взаймы или принимать какие-либо деньги, подарки, вознаграждение или компенсацию за ваши личные доходы от или в ином месте под денежный долг любому лицу/клиенту, с которым у вас могут быть официальные сделки.</p>



            <p>10. Прекращение</p>

            <p>10.1 Ваше назначение может быть прекращено компанией без каких бы то ни было оснований, предоставляя Вам не менее [ Уведомление] месяцев, предшея уведомлению в письменной форме или окладе вместо них. Для целей этого положения заработная плата означает базовый оклад.</p>

            <p>10.2 Вы можете прекратить свою трудовую деятельность с компанией без каких-либо причин, предоставляя не меньше, чем [ Employee Notice] months  предварительное уведомление или оклад за несохраненный период, оставатся после корректировки отложенных листьев, как на сегодняшний день.</p>

            <p>10.3 Компания оставляет за собой право прекратить вашу работу в суммарном порядке без какого-либо уведомления о сроке или увольнении, если у нее есть достаточные основания полагать, что вы виновны в проступке или халатности, или совершили какое-либо существенное нарушение договора, или причинило убытки Компании.&nbsp;</p>

            <p>10. 4 О прекращении вашей работы по какой бы то ни было причине вы вернетесь в Компании все имущество; документы, а&nbsp;</p>

            <p>бумаги, как оригинальные, так и их копии, включая любые образцы, литературу, контракты, записи, списки, чертежи, чертежи,</p>

            <p>письма, заметки, данные и тому подобное; и Конфиденциальная информация, в вашем распоряжении или под вашим контролем, связанным с вашей работой или деловыми делами клиентов.&nbsp; &nbsp;</p>



            <p>11. Конфиденциальная информация</p>

            <p>11. 1 Во время вашего трудоустройства с компанией Вы посвяте все свое время, внимание, умение максимально</p>

            <p>Его бизнес. Вы не должны, прямо или косвенно, заниматься или ассоциировать себя с заинтересованными, занятым, занятым, или временем, или продолжать любой курс обучения, без предварительного разрешения Компани.заниматься каким-либо другим бизнесом или деятельностью или любой другой пост или работать неполный рабочий день или заниматься какой бы то ни было исследованием, без предварительного разрешения</p>

            <p>Компания.</p>

            <p>11.2 Вы всегда должны сохранять наивысшую степень конфиденциальности и хранить в качестве конфиденциальной записи, документы и другие&nbsp;</p>

            <p>Конфиденциальная информация, касающаяся бизнеса Компании, которая может быть вам известна или конфиденциальна любым способом, и Вы будете использовать такие записи, документы и информацию только в установленном порядке в интересах Компании. Для целей настоящей статьи "Конфиденциальная информация" означает информацию о бизнесе Компании и о ее клиентах, которая недоступна для широкой общественности и которая может быть изучилась Вами в ходе вашей работы. Это включает в себя:</p>

            <p>но не ограничивается информацией, касающейся организации, ее списков клиентов, политики в области занятости, персонала и информации о продуктах Компании, процессах, включая идеи, концепции, прогнозы, технологии, руководства, чертеж, чертеж,&nbsp;</p>

            <p>спецификации, и все бумаги, резюме, записи и другие документы, содержащие такую Конфиденциальную Информацию.</p>

            <p>11.3 В любое время вы не будете удалять конфиденциальную информацию из офиса без разрешения.</p>

            <p>11.4 Ваш долг защищать и не отсосать</p>

            <p>e Конфиденциальная информация выдержит срок действия или прекращения действия настоящего Соглашения и/или вашей работы с компанией.</p>

            <p>11.5 Нарушение условий, изложенных в настоящем положении, приведет к тому, что в дополнение к любым другим средствам правовой защиты, которые компания может иметь против вас, в соответствии с вышеприведенным положением, вы можете получить краткое увольнение в соответствии с этим положением.</p>



            <p>12. Замечания</p>

            <p>Уведомления могут быть даны Вами Компании по адресу ее зарегистрированного офиса. Извещения могут быть даны компанией Вам по адресу, с которым вы в официальных отчетах.</p>



            <p>13. Применимость политики компании</p>

            <p>Компания вправе время от времени делать политические заявления по таким вопросам, как право на отпуск, материнство</p>

            <p>отпуска, пособия для работников, продолжительность рабочего дня, трансферная политика и т.д. и время от времени могут изменяться исключительно по своему усмотрению.</p>

            <p>Все такие принципиальные решения Компании являются обязательными для Вас и переопределяют это Соглашение в такой степени.</p>



            <p>14. Регулирующий Право/юрисдикция</p>

            <p>Ваше трудоустройство с компанией подпадает под действие законов страны. Все споры подлежат юрисдикции Высокого суда</p>

            <p>Только Гуджарат.</p>



            <p>15. Принятие нашего предложения</p>

            <p>Пожалуйста, подтвердите свое согласие с этим Договором о занятости, подписав и возвращая дубликат копии.</p>



            <p>Мы приветствуем Вас и надеемся на то, что Вы принимаете свое согласие и работаете с Вами.</p>



            <p>Искренне Ваш,</p>

            <p>{ app_name }</p>

            <p>{date}</p>
            ',

            'tr'=>'<h3 style="text-align: center;">Katılım Mektubu</h3>
            <p>{tarih}</p>
            <p>{çalışan_adı}</p>
            <p>{adres</p>
            <p>Konu: {tanımlama</p> görevi için randevu
            <p>Sayın {çalışan_adı},</p>
            <p>Aşağıdaki şartlar ve</p> ile Şirkette {app_name} ile {designation} konumunu size sunmaktan mutluluk duyuyoruz.</p>
            <p>koşullar:</p>
            <p>1. İşe başlama</p>
            <p>İstihdamınız {start_date}</p> itibarıyla geçerli olacak
            <p>2. İş unvanı</p>
            <p>İş unvanınız {tanımlama} olacaktır.</p>
            <p>3. maaş</p>
            <p>Maaşınız ve diğer yardımlarınız, bundan böyle Çizelge 1 de belirtildiği gibi olacaktır.</p>
            <p>4. Gönderim yeri</p>
            <p>{branch} adresinde ilan edileceksiniz. Ancak, Şirketin sahip olduğu herhangi bir işyerinde çalışmanız gerekebilir veya</p>
            <p>daha sonra edinilebilir.</p>
            <p>5. Çalışma Saatleri</p>
            <p>Normal çalışma günleri Pazartesi den Cuma ya kadardır. </p> için gerekli olan saatlerde çalışmanız istenecektir.
            <p>Şirkete karşı görevlerinizi uygun şekilde yerine getirme. Normal çalışma saatleri {start_time} ile {end_time} arasındadır ve siz</p>
            <p>Her hafta en az {total_hours} saat ve gerekirse sizin durumunuza bağlı olarak ek saat çalışması bekleniyor</p>
            <p>sorumluluklar.</p>
            <p>6. İzin/Tatiller</p>
            <p>6.1 12 günlük geçici izin hakkınız var.</p>
            <p>6.2 12 iş günü ücretli hastalık izni hakkınız var.</p>
            <p>6.3 Şirket, her yılın başında ilan edilen tatillerin listesini bildirecektir.</p>
            <p>7. Görevlerin niteliği</p>
            <p>Görevinizle ilgili tüm görevleri ve şirket olarak bu tür ek görevleri elinizden gelen en iyi şekilde yerine getireceksiniz</p>
            <p>zaman zaman performans sergilemeniz için sizi çağırabilir. Özel görevleriniz, buradaki Çizelge II de belirtilmiştir.</p>
            <p>8. Şirket mülkü</p>
            <p>Süreç boyunca resmi kullanım için size emanet edilmiş olabilecek Şirket mülkünü her zaman iyi durumda tutacaksınız</p>
            <p>istihdamınız ve ücretinizden feragat etmeden önce bu tür tüm mülkleri Şirkete iade edecektir, aksi takdirde maliyet</p>
            <p>Aynısı Şirket tarafından sizden geri alınacaktır.</p>
            <p>9. Ödünç alma/hediye kabul etme</p>
            <p>Kişisel kazançlarınız için kendinizden herhangi bir para, hediye, ödül veya tazminat ödünç almayacak veya kabul etmeyeceksiniz</p>
            <p>resmi ilişki içinde olabileceğiniz herhangi bir kişiye/müşteriye karşı maddi yükümlülük altında.</p>
            <p>10. Fesih</p>
            <p>10.1 Randevunuz, Şirket tarafından size en az [Bildirim] ay öncesinden bildirimde bulunarak herhangi bir sebep olmaksızın feshedilebilir</p>
            <p>yazılı bildirim veya bunun yerine maaş. Bu maddenin amaçları doğrultusunda maaş, temel maaş anlamına gelir.</p>
            <p>10.2 En az [Çalışan Bildirimi]</p> vererek Şirketteki çalışmanızı herhangi bir neden olmaksızın sonlandırabilirsiniz.
            <p>Tarih itibariyle, bekleyen izinlerin ayarlanmasından sonra kalan, kaydedilmemiş dönem için aylar öncesinden bildirim veya maaş.</p>
            <p>10.3 Şirket, herhangi bir ihbar süresi veya fesih ödemesi olmaksızın iş akdinizi aniden feshetme hakkını saklı tutar</p>
            <p>Suistimal veya ihmalden suçlu olduğunuza veya herhangi bir temel ihlalde bulunduğunuza inanmak için makul bir gerekçesi varsa</p>
            <p>sözleşmeye veya Şirkete herhangi bir zarara neden oldu.</p>
            <p>10. 4 Herhangi bir nedenle işinize son verildiğinde, tüm mal varlığınızı Şirkete iade edeceksiniz; belgeler ve</p>
            <p>Örnekler, literatür, sözleşmeler, kayıtlar, listeler, çizimler, ozalitler dahil kağıt, hem orijinali hem de kopyaları</p>
            <p>mektuplar, notlar, veriler ve benzerleri; ve Sizinle ilgili olarak sahip olduğunuz veya kontrolünüz altındaki Gizli Bilgiler</p>
            <p>istihdam veya müşterilerin iş ilişkileri.</p>
            <p>11. Gizli Bilgiler</p>
            <p>11. 1 Şirkette çalıştığınız süre boyunca tüm zamanınızı, dikkatinizi ve becerinizi elinizden gelenin en iyisini yapmaya adayacaksınız</p>
            <p>onun işi. Doğrudan veya dolaylı olarak kendinizle ilişki kurmamalı veya ilişkilendirmemeli, bunlarla bağlantı kurmamalı, ilgilenmemeli, istihdam edilmemeli veya</p>
            <p>Şirketin önceden izni olmaksızın herhangi bir eğitim kursuna katılmak veya devam etmek.Başka herhangi bir işle uğraşmak veya</p>
            <p>aktiviteler veya diğer herhangi bir görevlendirme veya yarı zamanlı çalışma veya herhangi bir eğitim kursuna devam etme,</p>
            <p>Şirket.</p>
            <p>11.2 Gizliliği her zaman en üst düzeyde tutmalı ve kayıtları, belgeleri ve diğer bilgileri gizli tutmalısınız</p>
            <p>Şirketin faaliyetleriyle ilgili olarak sizin tarafınızdan bilinebilecek veya herhangi bir şekilde size güvenilebilecek Gizli Bilgiler</p>
            <p>ve bu tür kayıtları, belgeleri ve bilgileri yalnızca Şirketin çıkarları doğrultusunda usulüne uygun olarak yetkilendirilmiş bir şekilde kullanacaksınız. için</p>
            <p>Bu maddenin amacı Gizli Bilgiler, Şirketin ve müşterilerinin işleri hakkında bilgiler anlamına gelir</p>
            <p>genel halka açık olmayan ve istihdamınız sırasında sizin tarafınızdan öğrenilebilecek bilgiler. Bu,</p>
            <p>kuruluşa, müşteri listelerine, istihdam politikalarına, personeline ve bilgilerine ilişkin bilgiler ve bunlarla sınırlı olmamak üzere</p>
            <p>Fikirler, kavramlar, projeksiyonlar, teknoloji, kılavuzlar, çizimler, tasarımlar dahil olmak üzere Şirketin ürünleri ve süreçleri hakkında</p>
            <p>şartnameler ve bu tür Gizli Bilgileri içeren tüm belgeler, özgeçmişler, kayıtlar ve diğer belgeler.</p>
            <p>11.3 Hiçbir Gizli Bilgiyi izinsiz olarak ofisten çıkarmayacaksınız.</p>
            <p>11.4 Koruma ve açıklamama göreviniz</p>
            <p>Gizli Bilgiler, bu Sözleşmenin sona ermesinden veya feshedilmesinden ve/veya Şirketteki istihdamınızın sona ermesinden sonra da geçerliliğini koruyacaktır.</p>
            <p>11.5 Bu maddenin koşullarının ihlal edilmesi, sizi herhangi bir ek olarak yukarıdaki madde kapsamında derhal işten çıkarmayla yükümlü kılacaktır</p>
            <p>Şirketin kanunen size karşı sahip olabileceği diğer çareler.</p>
            <p>12. Bildirimler</p>
            <p>Tebligatlar, tarafınızca Şirketin kayıtlı ofis adresine gönderilebilir. Bildirimler Şirket tarafından size şu adreste verilebilir:</p>
            <p>resmi kayıtlarda belirttiğiniz adres.</p>
            <p>13. Şirket Politikasının Uygulanabilirliği</p>
            <p>Şirket, izin hakkı, analık gibi konularda zaman zaman poliçe beyanı yapma hakkına sahip olacaktır</p>
            <p>izin, çalışanlara sağlanan faydalar, çalışma saatleri, transfer politikaları vb. ve tamamen kendi takdirine bağlı olarak zaman zaman aynı şeyi değiştirebilir.</p>
            <p>Şirketin bu tür tüm politika kararları sizin için bağlayıcı olacak ve bu Sözleşmeyi o ölçüde geçersiz kılacaktır.</p>
            <p>14. Geçerli Yasa/Yetki Alanı</p>
            <p>Şirketteki istihdamınız Ülke yasalarına tabidir. Tüm ihtilaflar Yüksek Mahkemenin yargı yetkisine tabi olacaktır</p>
            <p>Yalnızca Gujarat.</p>
            <p>15. Teklifimizin kabulü</p>
            <p>Lütfen bu İş Sözleşmesini kabul ettiğinizi imzalayarak ve kopya kopyayı geri vererek onaylayın.</p>
            <p>Hoş geldiniz ve kabulünüzü almayı ve sizinle çalışmayı sabırsızlıkla bekliyoruz.</p>
            <p>Saygılarımızla,</p>
            <p>{uygulama_adı}</p>
            <p>{tarih}</p>',

            'pt-br' => '<h3 style="text-align: center;">Carta De Ades&atilde;o</h3>

            <p>{data}</p>

            <p>{employee_name}</p>

            <p>{address}</p>


            <p>Assunto: Nomea&ccedil;&atilde;o para o cargo de {designation}</p>

            <p>Querido {employee_name},</p>


            <p>Temos o prazer de oferec&ecirc;-lo, a posi&ccedil;&atilde;o de {designation} com {app_name} a Empresa nos seguintes termos e</p>
            <p>condi&ccedil;&otilde;es:</p>


            <p>1. Comentamento do emprego</p>

            <p>Seu emprego ser&aacute; efetivo, a partir de {start_date}</p>


            <p>2. T&iacute;tulo do emprego</p>

            <p>Seu cargo de trabalho ser&aacute; {designation}.</p>

            <p>3. Sal&aacute;rio</p>

            <p>Seu sal&aacute;rio e outros benef&iacute;cios ser&atilde;o conforme estabelecido no Planejamento 1, hereto.</p>

            <p>4. Local de postagem</p>

            <p>Voc&ecirc; ser&aacute; postado em {branch}. Voc&ecirc; pode, no entanto, ser obrigado a trabalhar em qualquer local de neg&oacute;cios que a Empresa tenha, ou possa posteriormente adquirir.</p>

            <p>5. Horas de Trabalho</p>

            <p>Os dias normais de trabalho s&atilde;o de segunda a sexta-feira. Voc&ecirc; ser&aacute; obrigado a trabalhar por tais horas, conforme necess&aacute;rio para a quita&ccedil;&atilde;o adequada de suas fun&ccedil;&otilde;es para a Companhia. As horas de trabalho normais s&atilde;o de {start_time} para {end_time} e voc&ecirc; deve trabalhar n&atilde;o menos de {total_horas} horas semanais, e se necess&aacute;rio para horas adicionais dependendo do seu</p>
            <p>responsabilidades.</p>

            <p>6. Leave / Holidays</p>

            <p>6,1 Voc&ecirc; tem direito a licen&ccedil;a casual de 12 dias.</p>

            <p>6,2 Voc&ecirc; tem direito a 12 dias &uacute;teis de licen&ccedil;a remunerada remunerada.</p>

            <p>6,3 Companhia notificar&aacute; uma lista de feriados declarados no in&iacute;cio de cada ano.&nbsp;</p>



            <p>7. Natureza dos deveres</p>

            <p>Voc&ecirc; ir&aacute; executar ao melhor da sua habilidade todos os deveres como s&atilde;o inerentes ao seu cargo e tais deveres adicionais como a empresa pode ligar sobre voc&ecirc; para executar, de tempos em tempos. Os seus deveres espec&iacute;ficos s&atilde;o estabelecidos no Hereto do Planejamento II.</p>



            <p>8. Propriedade da empresa</p>

            <p>Voc&ecirc; sempre manter&aacute; em bom estado propriedade Empresa, que poder&aacute; ser confiada a voc&ecirc; para uso oficial durante o curso de</p>

            <p>o seu emprego, e devolver&aacute; toda essa propriedade &agrave; Companhia antes de abdicar de sua acusa&ccedil;&atilde;o, falhando qual o custo do mesmo ser&aacute; recuperado de voc&ecirc; pela Companhia.</p>



            <p>9. Borremir / aceitar presentes</p>

            <p>Voc&ecirc; n&atilde;o vai pedir empr&eacute;stimo ou aceitar qualquer dinheiro, presente, recompensa ou indeniza&ccedil;&atilde;o por seus ganhos pessoais de ou de outra forma colocar-se sob obriga&ccedil;&atilde;o pecuni&aacute;ria a qualquer pessoa / cliente com quem voc&ecirc; pode estar tendo rela&ccedil;&otilde;es oficiais.</p>



            <p>10. Termina&ccedil;&atilde;o</p>

            <p>10,1 Sua nomea&ccedil;&atilde;o pode ser rescindida pela Companhia, sem qualquer raz&atilde;o, dando-lhe n&atilde;o menos do que [aviso] meses de aviso pr&eacute;vio por escrito ou de sal&aacute;rio em lieu deste. Para efeito da presente cl&aacute;usula, o sal&aacute;rio deve significar sal&aacute;rio base.</p>

            <p>10,2 Voc&ecirc; pode rescindir seu emprego com a Companhia, sem qualquer causa, ao dar nada menos que [Aviso de contrata&ccedil;&atilde;o] meses de aviso pr&eacute;vio ou sal&aacute;rio para o per&iacute;odo n&atilde;o salvo, deixado ap&oacute;s ajuste de folhas pendentes, conforme data de encontro.</p>

            <p>10,3 Empresa reserva-se o direito de rescindir o seu emprego sumariamente sem qualquer prazo de aviso ou de rescis&atilde;o se tiver terreno razo&aacute;vel para acreditar que voc&ecirc; &eacute; culpado de m&aacute; conduta ou neglig&ecirc;ncia, ou tenha cometido qualquer viola&ccedil;&atilde;o fundamental de contrato, ou tenha causado qualquer perda para a Empresa.&nbsp;</p>

            <p>10. 4 Sobre a rescis&atilde;o do seu emprego por qualquer motivo, voc&ecirc; retornar&aacute; para a Empresa todos os bens; documentos e&nbsp;</p>

            <p>papel, tanto originais como c&oacute;pias dos mesmos, incluindo quaisquer amostras, literatura, contratos, registros, listas, desenhos, plantas,</p>

            <p>cartas, notas, dados e semelhantes; e Informa&ccedil;&otilde;es Confidenciais, em sua posse ou sob seu controle relacionado ao seu emprego ou aos neg&oacute;cios de neg&oacute;cios dos clientes.&nbsp; &nbsp;</p>



            <p>11. Informa&ccedil;&otilde;es Confidenciais</p>

            <p>11. 1 Durante o seu emprego com a Companhia voc&ecirc; ir&aacute; dedicar todo o seu tempo, aten&ccedil;&atilde;o e habilidade para o melhor de sua capacidade de</p>

            <p>o seu neg&oacute;cio. Voc&ecirc; n&atilde;o deve, direta ou indiretamente, se envolver ou associar-se com, estar conectado com, preocupado, empregado, ou tempo ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do Company.engajado em qualquer outro neg&oacute;cio ou atividades ou qualquer outro cargo ou trabalho parcial ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do</p>

            <p>Empresa.</p>

            <p>11,2 &Eacute; preciso manter sempre o mais alto grau de confidencialidade e manter como confidenciais os registros, documentos e outros&nbsp;</p>

            <p>Informa&ccedil;&otilde;es confidenciais relativas ao neg&oacute;cio da Companhia que possam ser conhecidas por voc&ecirc; ou confiadas em voc&ecirc; por qualquer meio e utilizar&atilde;o tais registros, documentos e informa&ccedil;&otilde;es apenas de forma devidamente autorizada no interesse da Companhia. Para efeitos da presente cl&aacute;usula "Informa&ccedil;&otilde;es confidenciais" significa informa&ccedil;&atilde;o sobre os neg&oacute;cios da Companhia e a dos seus clientes que n&atilde;o est&aacute; dispon&iacute;vel para o p&uacute;blico em geral e que poder&aacute; ser aprendida por voc&ecirc; no curso do seu emprego. Isso inclui,</p>

            <p>mas n&atilde;o se limita a, informa&ccedil;&otilde;es relativas &agrave; organiza&ccedil;&atilde;o, suas listas de clientes, pol&iacute;ticas de emprego, pessoal, e informa&ccedil;&otilde;es sobre os produtos da Companhia, processos incluindo ideias, conceitos, proje&ccedil;&otilde;es, tecnologia, manuais, desenho, desenhos,&nbsp;</p>

            <p>especifica&ccedil;&otilde;es, e todos os pap&eacute;is, curr&iacute;culos, registros e outros documentos que contenham tais Informa&ccedil;&otilde;es Confidenciais.</p>

            <p>11,3 Em nenhum momento, voc&ecirc; remover&aacute; quaisquer Informa&ccedil;&otilde;es Confidenciais do escrit&oacute;rio sem permiss&atilde;o.</p>

            <p>11,4 O seu dever de salvaguardar e n&atilde;o os desclos</p>

            <p>Informa&ccedil;&otilde;es Confidenciais sobreviver&atilde;o &agrave; expira&ccedil;&atilde;o ou &agrave; rescis&atilde;o deste Contrato e / ou do seu emprego com a Companhia.</p>

            <p>11,5 Viola&ccedil;&atilde;o das condi&ccedil;&otilde;es desta cl&aacute;usula ir&aacute; torn&aacute;-lo sujeito a demiss&atilde;o sum&aacute;ria sob a cl&aacute;usula acima, al&eacute;m de qualquer outro rem&eacute;dio que a Companhia possa ter contra voc&ecirc; em lei.</p>



            <p>12. Notices</p>

            <p>Os avisos podem ser conferidos por voc&ecirc; &agrave; Empresa em seu endere&ccedil;o de escrit&oacute;rio registrado. Os avisos podem ser conferidos pela Companhia a voc&ecirc; no endere&ccedil;o intimado por voc&ecirc; nos registros oficiais.</p>



            <p>13. Aplicabilidade da Pol&iacute;tica da Empresa</p>

            <p>A Companhia tem direito a fazer declara&ccedil;&otilde;es de pol&iacute;tica de tempos em tempos relativos a mat&eacute;rias como licen&ccedil;a de licen&ccedil;a, maternidade</p>

            <p>sair, benef&iacute;cios dos empregados, horas de trabalho, pol&iacute;ticas de transfer&ecirc;ncia, etc., e pode alterar o mesmo de vez em quando a seu exclusivo crit&eacute;rio.</p>

            <p>Todas essas decis&otilde;es de pol&iacute;tica da Companhia devem ser vinculativas para si e substituir&atilde;o este Acordo nessa medida.</p>



            <p>14. Direito / Jurisdi&ccedil;&atilde;o</p>

            <p>Seu emprego com a Companhia est&aacute; sujeito &agrave;s leis do Pa&iacute;s. Todas as disputas est&atilde;o sujeitas &agrave; jurisdi&ccedil;&atilde;o do Tribunal Superior</p>

            <p>Gujarat apenas.</p>



            <p>15. Aceita&ccedil;&atilde;o da nossa oferta</p>

            <p>Por favor, confirme sua aceita&ccedil;&atilde;o deste Contrato de Emprego assinando e retornando a c&oacute;pia duplicada.</p>



            <p>N&oacute;s acolhemos voc&ecirc; e estamos ansiosos para receber sua aceita&ccedil;&atilde;o e para trabalhar com voc&ecirc;.</p>



            <p>Seu Sinceramente,</p>

            <p>{app_name}</p>

            <p>{data}</p>
            ',


     ];

        foreach($defaultTemplate as $lang => $content)
        {
            JoiningLetter::create(
                [
                    'lang' => $lang,
                    'content' => $content,
                    'created_by' => 2,

                ]
            );
        }

    }
    public static function defaultJoiningLetterRegister($user_id)
    {

        $defaultTemplate = [

            'ar' => '<h2 style="text-align: center;"><strong>خطاب الانضمام</strong></h2>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>الموضوع: موعد لوظيفة {designation}</p>
            <p>عزيزي {employee_name} ،</p>
            <p>يسعدنا أن نقدم لك منصب {designation} مع {app_name} "الشركة" وفقًا للشروط التالية و</p>
            <p>الظروف:</p>
            <p>1. بدء العمل</p>
            <p>سيصبح عملك ساريًا اعتبارًا من {start_date}</p>
            <p>2. المسمى الوظيفي</p>
            <p>سيكون المسمى الوظيفي الخاص بك هو {designation}.</p>
            <p>3. الراتب</p>
            <p>سيكون راتبك والمزايا الأخرى على النحو المبين في الجدول 1 ، طيه.</p>
            <p>4. مكان الإرسال</p>
            <p>سيتم إرسالك إلى {branch}. ومع ذلك ، قد يُطلب منك العمل في أي مكان عمل تمتلكه الشركة ، أو</p>
            <p>قد تحصل لاحقًا.</p>
            <p>5. ساعات العمل</p>
            <p>أيام العمل العادية هي من الاثنين إلى الجمعة. سيُطلب منك العمل لساعات حسب الضرورة لـ</p>
            <p>أداء واجباتك على النحو الصحيح تجاه الشركة. ساعات العمل العادية من {start_time} إلى {end_time} وأنت</p>
            <p>من المتوقع أن يعمل ما لا يقل عن {total_hours} ساعة كل أسبوع ، وإذا لزم الأمر لساعات إضافية اعتمادًا على</p>
            <p>المسؤوليات.</p>
            <p>6. الإجازة / العطل</p>
            <p>6.1 يحق لك الحصول على إجازة غير رسمية مدتها 12 يومًا.</p>
            <p>6.2 يحق لك الحصول على إجازة مرضية مدفوعة الأجر لمدة 12 يوم عمل.</p>
            <p>6.3 تخطر الشركة بقائمة الإجازات المعلنة في بداية كل عام.</p>
            <p>7. طبيعة الواجبات</p>
            <p>ستقوم بأداء أفضل ما لديك من واجبات متأصلة في منصبك ومهام إضافية مثل الشركة</p>
            <p>قد يدعوك لأداء ، من وقت لآخر. واجباتك المحددة منصوص عليها في الجدول الثاني بهذه الرسالة.</p>
            <p>8. ممتلكات الشركة</p>
            <p>ستحافظ دائمًا على ممتلكات الشركة في حالة جيدة ، والتي قد يتم تكليفك بها للاستخدام الرسمي خلال فترة عملها</p>
            <p>عملك ، ويجب أن تعيد جميع هذه الممتلكات إلى الشركة قبل التخلي عن الرسوم الخاصة بك ، وإلا فإن التكلفة</p>
            <p>نفس الشيء سوف تسترده منك الشركة.</p>
            <p>9. الاقتراض / قبول الهدايا</p>
            <p>لن تقترض أو تقبل أي أموال أو هدية أو مكافأة أو تعويض مقابل مكاسبك الشخصية من أو تضع نفسك بأي طريقة أخرى</p>
            <p>بموجب التزام مالي تجاه أي شخص / عميل قد تكون لديك تعاملات رسمية معه.</p>
            <p>10. الإنهاء</p>
            <p>10.1 يمكن للشركة إنهاء موعدك ، دون أي سبب ، من خلال إعطائك ما لا يقل عن [إشعار] قبل أشهر</p>
            <p>إشعار خطي أو راتب بدلاً منه. لغرض هذا البند ، يقصد بالراتب المرتب الأساسي.</p>
            <p>10.2 إنهاء عملك مع الشركة ، دون أي سبب ، من خلال تقديم ما لا يقل عن إشعار الموظف</p>
            <p>أشهر الإخطار أو الراتب عن الفترة غير المحفوظة ، المتبقية بعد تعديل الإجازات المعلقة ، كما في التاريخ.</p>
            <p>10.3 تحتفظ الشركة بالحق في إنهاء عملك بإيجاز دون أي فترة إشعار أو مدفوعات إنهاء</p>
            <p>إذا كان لديه سبب معقول للاعتقاد بأنك مذنب بسوء السلوك أو الإهمال ، أو ارتكبت أي خرق جوهري لـ</p>
            <p>العقد ، أو تسبب في أي خسارة للشركة.</p>
            <p>10. 4 عند إنهاء عملك لأي سبب من الأسباب ، ستعيد إلى الشركة جميع ممتلكاتك ؛ المستندات و</p>
            <p>الأوراق الأصلية ونسخها ، بما في ذلك أي عينات ، وأدبيات ، وعقود ، وسجلات ، وقوائم ، ورسومات ، ومخططات ،</p>
            <p>الرسائل والملاحظات والبيانات وما شابه ذلك ؛ والمعلومات السرية التي بحوزتك أو تحت سيطرتك والمتعلقة بك</p>
            <p>التوظيف أو الشؤون التجارية للعملاء.</p>
            <p>11. المعلومات السرية</p>
            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>
            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>
            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>
            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>
            <p>شركة.</p>
            <p>11. المعلومات السرية</p>
            <p>11. 1 أثناء عملك في الشركة ، سوف تكرس وقتك واهتمامك ومهارتك كلها بأفضل ما لديك من قدرات</p>
            <p>عملها. لا يجوز لك ، بشكل مباشر أو غير مباشر ، الانخراط أو الارتباط بنفسك ، أو الارتباط به ، أو القلق ، أو التوظيف ، أو</p>
            <p>الوقت أو متابعة أي دورة دراسية على الإطلاق ، دون الحصول على إذن مسبق من الشركة أو الانخراط في أي عمل آخر أو</p>
            <p>الأنشطة أو أي وظيفة أخرى أو العمل بدوام جزئي أو متابعة أي دورة دراسية على الإطلاق ، دون إذن مسبق من</p>
            <p>شركة.</p>
            <p>11.2 يجب عليك دائمًا الحفاظ على أعلى درجة من السرية والحفاظ على سرية السجلات والوثائق وغيرها</p>
            <p>المعلومات السرية المتعلقة بأعمال الشركة والتي قد تكون معروفة لك أو مخولة لك بأي وسيلة</p>
            <p>ولن تستخدم هذه السجلات والمستندات والمعلومات إلا بالطريقة المصرح بها حسب الأصول لصالح الشركة. إلى عن على</p>
            <p>أغراض هذا البند "المعلومات السرية" تعني المعلومات المتعلقة بأعمال الشركة وعملائها</p>
            <p>التي لا تتوفر لعامة الناس والتي قد تتعلمها أثناء عملك. هذا يشمل،</p>
            <p>على سبيل المثال لا الحصر ، المعلومات المتعلقة بالمنظمة وقوائم العملاء وسياسات التوظيف والموظفين والمعلومات</p>
            <p>حول منتجات الشركة وعملياتها بما في ذلك الأفكار والمفاهيم والإسقاطات والتكنولوجيا والكتيبات والرسم والتصاميم ،</p>
            <p>المواصفات وجميع الأوراق والسير الذاتية والسجلات والمستندات الأخرى التي تحتوي على هذه المعلومات السرية.</p>
            <p>11.3 لن تقوم في أي وقت بإزالة أي معلومات سرية من المكتب دون إذن.</p>
            <p>11.4 واجبك في الحماية وعدم الإفشاء</p>
            <p>تظل المعلومات السرية سارية بعد انتهاء أو إنهاء هذه الاتفاقية و / أو عملك مع الشركة.</p>
            <p>11.5 سوف يجعلك خرق شروط هذا البند عرضة للفصل بإجراءات موجزة بموجب الفقرة أعلاه بالإضافة إلى أي</p>
            <p>أي تعويض آخر قد يكون للشركة ضدك في القانون.</p>
            <p>12. الإخطارات</p>
            <p>يجوز لك إرسال إخطارات إلى الشركة على عنوان مكتبها المسجل. يمكن أن ترسل لك الشركة إشعارات على</p>
            <p>العنوان الذي أشرت إليه في السجلات الرسمية.</p>
            <p>13. تطبيق سياسة الشركة</p>
            <p>يحق للشركة تقديم إعلانات السياسة من وقت لآخر فيما يتعلق بمسائل مثل استحقاق الإجازة والأمومة</p>
            <p>الإجازة ، ومزايا الموظفين ، وساعات العمل ، وسياسات النقل ، وما إلى ذلك ، ويمكن تغييرها من وقت لآخر وفقًا لتقديرها الخاص.</p>
            <p>جميع قرارات سياسة الشركة هذه ملزمة لك ويجب أن تلغي هذه الاتفاقية إلى هذا الحد.</p>
            <p>14. القانون الحاكم / الاختصاص القضائي</p>
            <p>يخضع عملك في الشركة لقوانين الدولة. تخضع جميع النزاعات للاختصاص القضائي للمحكمة العليا</p>
            <p>غوجارات فقط.</p>
            <p>15. قبول عرضنا</p>
            <p>يرجى تأكيد قبولك لعقد العمل هذا من خلال التوقيع وإعادة النسخة المكررة.</p>
            <p>نرحب بكم ونتطلع إلى تلقي موافقتكم والعمل معكم.</p>
            <p>تفضلوا بقبول فائق الاحترام،</p>
            <p>{app_name}</p>
            <p>{date}</p>',

            'zh' =>'<h3 style="text-align: center;">加入信</h3>
            <p>{日期}</p>
            <p>{employee_name}</p>
            <p>{地址}</p>
            <p>主题：任命 {designation} 职位</p>
            <p>亲爱的{employee_name}，</p>
            <p>我们很高兴根据以下条款向您提供 {app_name} theCompany 的 {designation} 职位，并且</p>
            <p>条件：</p>
            <p>1.开始就业</p>
            <p>您的雇佣关系将于 {start_date}起生效</p>
            <p>2.职位名称</p>
            <p>您的职位名称为{designation}。</p>
            <p>3.薪资</p>
            <p>您的工资和其他福利将在附表 1 中列出。</p>
            <p>4.发帖地点</p>
            <p>您将被调往{branch}。但是，您可能需要在公司拥有的任何营业地点工作，或者</p>
            <p>稍后可能会获得。</p>
            <p>5.工作时间</p>
            <p>正常工作日为周一至周五。您将需要在必要的时间内工作</p>
            <p>正确履行您对公司的职责。正常工作时间为 {start_time} 至 {end_time}，您</p>
            <p>预计每周工作不少于 {total_hours} 小时，如有必要，可根据您的情况增加工作时间</p>
            <p>职责。</p>
            <p>6.休假/节假日</p>
            <p>6.1 您有权享受 12 天的事假。</p>
            <p>6.2 您有权享受 12 个工作日的带薪病假。</p>
            <p>6.3 公司应在每年年初公布已宣布的假期清单。</p>
            <p>7.职责性质</p>
            <p>您将尽最大努力履行您职位固有的所有职责以及公司的额外职责</p>
            <p>可能会不时要求您表演。您的具体职责详见附表二。</p>
            <p>8.公司财产</p>
            <p>您将始终保持公司财产处于良好状态，这些财产可能会在工作期间委托给您用于官方使用</p>
            <p>您的工作，并应在放弃您的费用之前将所有此类财产归还给公司，否则费用</p>
            <p>公司将向您追回相同的内容。</p>
            <p>9.借用/接受礼物</p>
            <p>您不会借用或接受任何金钱、礼物、奖励或补偿来获取个人利益或以其他方式安置自己</p>
            <p>对可能与您进行正式交易的任何个人/客户承担金钱义务。</p>
            <p>10。终止</p>
            <p>10.1 公司可以在至少提前 [通知] 个月之前向您发出无任何理由的终止您的任命</p>
            <p>书面通知或工资代替。本条款中的工资是指基本工资。</p>
            <p>10.2 您可以通过发出不少于[员工通知]来终止与公司的雇佣关系，无需任何理由</p>
            <p>未保存期间的提前几个月通知或工资，在待休假调整后剩余，截至日期。</p>
            <p>10.3 公司保留立即终止您的雇佣关系的权利，无需任何通知期或终止付款</p>
            <p>如果有合理理由相信您犯有不当行为或疏忽，或犯有任何根本性违规行为</p>
            <p>合同，或给公司造成任何损失。</p>
            <p>10。 4.无论因何种原因终止雇佣关系，您应将所有财产返还给公司；文件，以及</p>
            <p>纸张，包括原件和副本，包括任何样本、文献、合同、记录、清单、图纸、蓝图，</p>
            <p>信件、笔记、数据等；您拥有或控制下的与您相关的机密信息</p>
            <p>就业或客户商务事务。</p>
            <p>11。机密信息</p>
            <p>11。 1 在您就职于公司期间，您将尽最大努力投入全部时间、注意力和技能，以实现</p>
            <p>它的业务。您不得直接或间接与以下人员接触或交往、与之有联系、涉及、受雇或参与</p>
            <p>未经公司事先许可，花时间或参加任何学习课程。从事任何其他业务或</p>
            <p>未经事先许可，进行活动或任何其他职位或兼职工作或进行任何学习课程</p>
            <p>公司。</p>
            <p>11.2 您必须始终保持最高程度的机密性，并对记录、文件和其他内容保密</p>
            <p>您可能知道或通过任何方式向您透露的与公司业务相关的机密信息</p>
            <p>您只能以符合公司利益的正式授权方式使用此类记录、文件和信息。对于</p>
            <p>本条款的目的机密信息是指有关公司业务及其客户业务的信息</p>
            <p>这对公众来说是无法获得的，但您可以在工作过程中了解到。这包括，</p>
            <p>但不限于与组织、其客户名单、雇佣政策、人员和信息相关的信息</p>
            <p>关于公司的产品、流程，包括想法、概念、预测、技术、手册、绘图、设计，</p>
            <p>规范以及包含此类机密信息的所有文件、简历、记录和其他文件。</p>
            <p>11.3 未经许可，您不得从办公室删除任何机密信息。</p>
            <p>11.4 您的保护义务和不披露义务</p>
            <p>在本协议期满或终止和/或您在公司任职后，机密信息将继续有效。</p>
            <p>11.5 违反本条款的条件将使您根据上述条款承担立即解雇的责任，此外还有任何责任</p>
            <p>公司可能根据法律对您采取的其他补救措施。</p>
            <p>12.通知</p>
            <p>您可以通过公司的注册办公地址向公司发出通知。公司可能会通过以下地址向您发出通知：</p>
            <p>您在官方记录中透露的地址。</p>
            <p>13。公司政策的适用性</p>
            <p>公司有权不时就休假、生育等事宜作出政策声明</p>
            <p>休假、员工福利、工作时间、调动政策等，并可能自行决定不时进行更改。</p>
            <p>公司的所有此类政策决定均对您具有约束力，并在一定程度上优先于本协议。</p>
            <p>14。适用法律/司法管辖区</p>
            <p>您在公司的雇佣关系须遵守国家/地区法律。所有争议均受高等法院管辖</p>
            <p>仅限古吉拉特邦。</p>
            <p>15。接受我们的报价</p>
            <p>请签署并返回副本以确认您接受本雇佣合同。</p>
            <p>我们欢迎您，并期待得到您的认可并与您合作。</p>
            <p>此致，</p>
            <p>{应用名称}</p>
            <p>{日期}</p>',

            'da' => '<h3 style="text-align: center;"><strong>Tilslutningsbrev</strong></h3>

            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>Emne: Udn&aelig;vnelse til stillingen som {designation}</p>
            <p>K&aelig;re {employee_name}</p>
            <p>Vi er glade for at kunne tilbyde dig stillingen som {designation} hos {app_name} "Virksomheden" p&aring; f&oslash;lgende vilk&aring;r og</p>
            <p>betingelser:</p>
            <p>1. P&aring;begyndelse af ans&aelig;ttelse</p>
            <p>Din ans&aelig;ttelse tr&aelig;der i kraft fra {start_date}</p>
            <p>2. Jobtitel</p>
            <p>Din jobtitel vil v&aelig;re {designation}.</p>
            <p>3. L&oslash;n</p>
            <p>Din l&oslash;n og andre goder vil v&aelig;re som angivet i skema 1, hertil.</p>
            <p>4. Udstationeringssted</p>
            <p>Du vil blive sl&aring;et op p&aring; {branch}. Du kan dog blive bedt om at arbejde p&aring; ethvert forretningssted, som virksomheden har, eller</p>
            <p>senere kan erhverve.</p>


            <p>5. Arbejdstimer</p>

            <p>De normale arbejdsdage er mandag til fredag. Du vil blive forpligtet til at arbejde i de timer, som er n&oslash;dvendige for</p>

            <p>beh&oslash;rig varetagelse af dine pligter over for virksomheden. Den normale arbejdstid er fra {start_time} til {end_time}, og det er du</p>

            <p>forventes at arbejde ikke mindre end {total_hours} timer hver uge, og om n&oslash;dvendigt yderligere timer afh&aelig;ngigt af din</p>

            <p>ansvar.</p>



            <p>6. Orlov/Ferie</p>

            <p>6.1 Du har ret til tilf&aelig;ldig ferie p&aring; 12 dage.</p>

            <p>6.2 Du har ret til 12 arbejdsdages sygefrav&aelig;r med l&oslash;n.</p>

            <p>6.3 Virksomheden skal meddele en liste over erkl&aelig;rede helligdage i begyndelsen af ​​hvert &aring;r.</p>



            <p>7. Arbejdsopgavernes art</p>

            <p>Du vil efter bedste evne udf&oslash;re alle de opgaver, der er iboende i din stilling og s&aring;danne yderligere opgaver som virksomheden</p>

            <p>kan opfordre dig til at optr&aelig;de, fra tid til anden. Dine specifikke pligter er beskrevet i skema II hertil.</p>


            <p>8. Firmaejendom</p>

            <p>Du vil altid vedligeholde virksomhedens ejendom i god stand, som kan blive overdraget til dig til officiel brug i l&oslash;bet af</p>

            <p>din ans&aelig;ttelse, og skal returnere al s&aring;dan ejendom til virksomheden, f&oslash;r du opgiver din afgift, i modsat fald vil omkostningerne</p>

            <p>af samme vil blive inddrevet fra dig af virksomheden.</p>



            <p>9. L&aring;n/modtagelse af gaver</p>

            <p>Du vil ikke l&aring;ne eller acceptere nogen penge, gave, bel&oslash;nning eller kompensation for dine personlige gevinster fra eller p&aring; anden m&aring;de placere dig selv</p>

            <p>under en &oslash;konomisk forpligtelse over for enhver person/kunde, som du m&aring;tte have officielle forbindelser med.</p>

            <p>10. Opsigelse</p>

            <p>10.1 Din ans&aelig;ttelse kan opsiges af virksomheden uden nogen grund ved at give dig mindst [varsel] m&aring;neder f&oslash;r</p>

            <p>skriftligt varsel eller l&oslash;n i stedet herfor. Ved l&oslash;n forst&aring;s i denne paragraf grundl&oslash;n.</p>

            <p>10.2 Du kan opsige dit ans&aelig;ttelsesforhold i virksomheden uden nogen grund ved at give mindst [Medarbejdermeddelelse]</p>

            <p>m&aring;neders forudg&aring;ende varsel eller l&oslash;n for den ikke-opsparede periode, tilbage efter regulering af afventende orlov, som p&aring; dato.</p>

            <p>10.3 Virksomheden forbeholder sig retten til at opsige dit ans&aelig;ttelsesforhold midlertidigt uden opsigelsesfrist eller opsigelsesbetaling</p>

            <p>hvis den har rimelig grund til at tro, at du er skyldig i forseelse eller uagtsomhed, eller har beg&aring;et et grundl&aelig;ggende brud p&aring;</p>

            <p>kontrakt, eller for&aring;rsaget tab for virksomheden.</p>

            <p>10. 4 Ved oph&oslash;r af din ans&aelig;ttelse uanset &aring;rsag, vil du returnere al ejendom til virksomheden; dokumenter, og</p>

            <p>papir, b&aring;de originale og kopier heraf, inklusive pr&oslash;ver, litteratur, kontrakter, optegnelser, lister, tegninger, tegninger,</p>

            <p>breve, notater, data og lignende; og fortrolige oplysninger, i din besiddelse eller under din kontrol vedr&oslash;rende din</p>

            <p>ans&aelig;ttelse eller til kunders forretningsforhold.</p>
            <p>11. Fortrolige oplysninger</p>

            <p>11. 1 Under din ans&aelig;ttelse i virksomheden vil du bruge al din tid, opm&aelig;rksomhed og dygtighed efter bedste evne til</p>

            <p>sin virksomhed. Du m&aring; ikke, direkte eller indirekte, engagere eller associere dig med, v&aelig;re forbundet med, bekymret, ansat eller</p>

            <p>tid eller forf&oslash;lge et hvilket som helst studieforl&oslash;b uden forudg&aring;ende tilladelse fra virksomheden. involveret i anden virksomhed eller</p>

            <p>aktiviteter eller enhver anden stilling eller arbejde p&aring; deltid eller forf&oslash;lge ethvert studieforl&oslash;b uden forudg&aring;ende tilladelse fra</p>

            <p>Selskab.</p>
            <p>11.2 Du skal altid opretholde den h&oslash;jeste grad af fortrolighed og opbevare optegnelser, dokumenter og andre fortrolige oplysninger.</p>

            <p>Fortrolige oplysninger vedr&oslash;rende virksomhedens virksomhed, som kan v&aelig;re kendt af dig eller betroet dig p&aring; nogen m&aring;de</p>

            <p>og du vil kun bruge s&aring;danne optegnelser, dokumenter og oplysninger p&aring; en beh&oslash;rigt autoriseret m&aring;de i virksomhedens interesse. Til</p>

            <p>form&aring;lene med denne paragraf "Fortrolige oplysninger" betyder oplysninger om virksomhedens og dets kunders forretning</p>

            <p>som ikke er tilg&aelig;ngelig for offentligheden, og som du kan l&aelig;re i l&oslash;bet af din ans&aelig;ttelse. Dette inkluderer,</p>

            <p>men er ikke begr&aelig;nset til information vedr&oslash;rende organisationen, dens kundelister, ans&aelig;ttelsespolitikker, personale og information</p>

            <p>om virksomhedens produkter, processer, herunder ideer, koncepter, projektioner, teknologi, manualer, tegning, design,</p>

            <p>specifikationer og alle papirer, CVer, optegnelser og andre dokumenter, der indeholder s&aring;danne fortrolige oplysninger.</p>

            <p>11.3 Du vil p&aring; intet tidspunkt fjerne fortrolige oplysninger fra kontoret uden tilladelse.</p>

            <p>11.4 Din pligt til at beskytte og ikke oplyse</p>

            <p>e Fortrolige oplysninger vil overleve udl&oslash;bet eller opsigelsen af ​​denne aftale og/eller din ans&aelig;ttelse hos virksomheden.</p>

            <p>11.5 Overtr&aelig;delse af betingelserne i denne klausul vil g&oslash;re dig ansvarlig for midlertidig afskedigelse i henhold til klausulen ovenfor ud over evt.</p>

            <p>andre retsmidler, som virksomheden m&aring;tte have mod dig i henhold til loven.</p>
            <p>12. Meddelelser</p>

            <p>Meddelelser kan gives af dig til virksomheden p&aring; dets registrerede kontoradresse. Meddelelser kan gives af virksomheden til dig p&aring;</p>

            <p>den adresse, du har angivet i de officielle optegnelser.</p>



            <p>13. Anvendelse af virksomhedens politik</p>

            <p>Virksomheden er berettiget til fra tid til anden at afgive politiske erkl&aelig;ringer vedr&oslash;rende sager som ret til orlov, barsel</p>

            <p>orlov, ansattes ydelser, arbejdstider, overf&oslash;rselspolitikker osv., og kan &aelig;ndre det samme fra tid til anden efter eget sk&oslash;n.</p>

            <p>Alle s&aring;danne politiske beslutninger fra virksomheden er bindende for dig og tilsides&aelig;tter denne aftale i det omfang.</p>



            <p>14. G&aelig;ldende lov/Jurisdiktion</p>

            <p>Din ans&aelig;ttelse hos virksomheden er underlagt landets love. Alle tvister er underlagt High Courts jurisdiktion</p>

            <p>Kun Gujarat.</p>



            <p>15. Accept af vores tilbud</p>

            <p>Bekr&aelig;ft venligst din accept af denne ans&aelig;ttelseskontrakt ved at underskrive og returnere kopien.</p>



            <p>Vi byder dig velkommen og ser frem til at modtage din accept og til at arbejde sammen med dig.</p>



            <p>Venlig hilsen,</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'de' => '<h3 style="text-align: center;"><strong>Beitrittsbrief</strong></h3>

            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>



            <p>Betreff: Ernennung f&uuml;r die Stelle von {designation}</p>







            <p>Sehr geehrter {employee_name},</p>



            <p>Wir freuen uns, Ihnen die Position von {designation} bei {app_name} dem &bdquo;Unternehmen&ldquo; zu den folgenden Bedingungen anbieten zu k&ouml;nnen</p>

            <p>Bedingungen:</p>


            <p>1. Aufnahme des Arbeitsverh&auml;ltnisses</p>

            <p>Ihre Anstellung gilt ab dem {start_date}</p>


            <p>2. Berufsbezeichnung</p>

            <p>Ihre Berufsbezeichnung lautet {designation}.</p>


            <p>3. Gehalt</p>

            <p>Ihr Gehalt und andere Leistungen sind in Anhang 1 zu diesem Dokument aufgef&uuml;hrt.</p>


            <p>4. Postort</p>

            <p>Sie werden bei {branch} eingestellt. Es kann jedoch erforderlich sein, dass Sie an jedem Gesch&auml;ftssitz arbeiten, den das Unternehmen hat, oder</p>

            <p>sp&auml;ter erwerben kann.</p>


            <p>5. Arbeitszeit</p>
            <p>Die normalen Arbeitstage sind Montag bis Freitag. Sie m&uuml;ssen so viele Stunden arbeiten, wie es f&uuml;r die erforderlich ist</p>
            <p>ordnungsgem&auml;&szlig;e Erf&uuml;llung Ihrer Pflichten gegen&uuml;ber dem Unternehmen. Die normalen Arbeitszeiten sind von {start_time} bis {end_time} und Sie sind es</p>
            <p>voraussichtlich nicht weniger als {total_hours} Stunden pro Woche arbeiten, und falls erforderlich, abh&auml;ngig von Ihren zus&auml;tzlichen Stunden</p>
            <p>Verantwortlichkeiten.</p>



            <p>6. Urlaub/Urlaub</p>

            <p>6.1 Sie haben Anspruch auf Freizeiturlaub von 12 Tagen.</p>

            <p>6.2 Sie haben Anspruch auf 12 Arbeitstage bezahlten Krankenurlaub.</p>

            <p>6.3 Das Unternehmen teilt zu Beginn jedes Jahres eine Liste der erkl&auml;rten Feiertage mit.</p>



            <p>7. Art der Pflichten</p>

            <p>Sie werden alle Aufgaben, die mit Ihrer Funktion verbunden sind, sowie alle zus&auml;tzlichen Aufgaben als Unternehmen nach besten Kr&auml;ften erf&uuml;llen</p>

            <p>kann Sie von Zeit zu Zeit zur Leistung auffordern. Ihre spezifischen Pflichten sind in Anhang II zu diesem Dokument aufgef&uuml;hrt.</p>



            <p>8. Firmeneigentum</p>

            <p>Sie werden das Firmeneigentum, das Ihnen im Laufe der Zeit f&uuml;r offizielle Zwecke anvertraut werden kann, stets in gutem Zustand halten</p>

            <p>Ihrer Anstellung und muss all dieses Eigentum an das Unternehmen zur&uuml;ckgeben, bevor Sie Ihre Geb&uuml;hr aufgeben, andernfalls die Kosten</p>

            <p>derselben werden von der Gesellschaft von Ihnen zur&uuml;ckgefordert.</p>



            <p>9. Leihen/Annehmen von Geschenken</p>

            <p>Sie werden kein Geld, Geschenk, keine Belohnung oder Entsch&auml;digung f&uuml;r Ihre pers&ouml;nlichen Gewinne von sich leihen oder annehmen oder sich anderweitig platzieren</p>

            <p>unter finanzieller Verpflichtung gegen&uuml;ber Personen/Kunden, mit denen Sie m&ouml;glicherweise dienstliche Beziehungen unterhalten.</p>

            <p>10. K&uuml;ndigung</p>

            <p>10.1 Ihre Ernennung kann vom Unternehmen ohne Angabe von Gr&uuml;nden gek&uuml;ndigt werden, indem es Ihnen mindestens [K&uuml;ndigung] Monate im Voraus mitteilt</p>

            <p>schriftliche K&uuml;ndigung oder Gehalt statt dessen. Gehalt im Sinne dieser Klausel bedeutet Grundgehalt.</p>

            <p>10.2 Sie k&ouml;nnen Ihre Anstellung beim Unternehmen ohne Angabe von Gr&uuml;nden k&uuml;ndigen, indem Sie mindestens [Mitarbeitermitteilung]</p>

            <p>K&uuml;ndigungsfrist von Monaten oder Gehalt f&uuml;r den nicht angesparten Zeitraum, der nach Anpassung der anstehenden Urlaubstage &uuml;brig bleibt, zum Stichtag.</p>

            <p>10.3 Das Unternehmen beh&auml;lt sich das Recht vor, Ihr Arbeitsverh&auml;ltnis ohne K&uuml;ndigungsfrist oder Abfindungszahlung fristlos zu k&uuml;ndigen</p>

            <p>wenn es begr&uuml;ndeten Anlass zu der Annahme gibt, dass Sie sich eines Fehlverhaltens oder einer Fahrl&auml;ssigkeit schuldig gemacht haben oder einen wesentlichen Versto&szlig; begangen haben</p>

            <p>oder dem Unternehmen Verluste verursacht haben.</p>

            <p>10. 4 Bei Beendigung Ihres Besch&auml;ftigungsverh&auml;ltnisses, aus welchem ​​Grund auch immer, werden Sie s&auml;mtliches Eigentum an das Unternehmen zur&uuml;ckgeben; Dokumente und</p>

            <p>Papier, sowohl Original als auch Kopien davon, einschlie&szlig;lich aller Muster, Literatur, Vertr&auml;ge, Aufzeichnungen, Listen, Zeichnungen, Blaupausen,</p>

            <p>Briefe, Notizen, Daten und dergleichen; und vertrauliche Informationen, die sich in Ihrem Besitz oder unter Ihrer Kontrolle befinden und sich auf Sie beziehen</p>

            <p>Besch&auml;ftigung oder f&uuml;r die gesch&auml;ftlichen Angelegenheiten der Kunden.</p>

            <p>11. Confidential Information</p>

            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>

            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>

            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>

            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>

            <p>Company.</p>

            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>

            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>

            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>

            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>

            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>

            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>

            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>

            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>

            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>

            <p>11.4 Your duty to safeguard and not disclos</p>

            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>

            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>

            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>

            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>

            <p>the address intimated by you in the official records.</p>



            <p>13. Applicability of Company Policy</p>

            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>

            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>

            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>



            <p>14. Governing Law/Jurisdiction</p>

            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>

            <p>Gujarat only.</p>



            <p>15. Acceptance of our offer</p>

            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>



            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>



            <p>Yours Sincerely,</p>

            <p>{app_name}</p>

            <p>{date}</p>',
            'en' => '<h3 style="text-align: center;">Joining Letter</h3>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>Subject: Appointment for the post of {designation}</p>
            <p>Dear {employee_name},</p>
            <p>We are pleased to offer you the position of {designation} with {app_name} theCompany on the following terms and</p>
            <p>conditions:</p>
            <p>1. Commencement of employment</p>
            <p>Your employment will be effective, as of {start_date}</p>
            <p>2. Job title</p>
            <p>Your job title will be{designation}.</p>
            <p>3. Salary</p>
            <p>Your salary and other benefits will be as set out in Schedule 1, hereto.</p>
            <p>4. Place of posting</p>
            <p>You will be posted at {branch}. You may however be required to work at any place of business which the Company has, or</p>
            <p>may later acquire.</p>
            <p>5. Hours of Work</p>
            <p>The normal working days are Monday through Friday. You will be required to work for such hours as necessary for the</p>
            <p>proper discharge of your duties to the Company. The normal working hours are from {start_time} to {end_time} and you are</p>
            <p>expected to work not less than {total_hours} hours each week, and if necessary for additional hours depending on your</p>
            <p>responsibilities.</p>
            <p>6. Leave/Holidays</p>
            <p>6.1 You are entitled to casual leave of 12 days.</p>
            <p>6.2 You are entitled to 12 working days of paid sick leave.</p>
            <p>6.3 The Company shall notify a list of declared holidays at the beginning of each year.</p>
            <p>7. Nature of duties</p>
            <p>You will perform to the best of your ability all the duties as are inherent in your post and such additional duties as the company</p>
            <p>may call upon you to perform, from time to time. Your specific duties are set out in Schedule II hereto.</p>
            <p>8. Company property</p>
            <p>You will always maintain in good condition Company property, which may be entrusted to you for official use during the course of</p>
            <p>your employment, and shall return all such property to the Company prior to relinquishment of your charge, failing which the cost</p>
            <p>of the same will be recovered from you by the Company.</p>
            <p>9. Borrowing/accepting gifts</p>
            <p>You will not borrow or accept any money, gift, reward, or compensation for your personal gains from or otherwise place yourself</p>
            <p>under pecuniary obligation to any person/client with whom you may be having official dealings.</p>
            <p>10. Termination</p>
            <p>10.1 Your appointment can be terminated by the Company, without any reason, by giving you not less than [Notice] months prior</p>
            <p>notice in writing or salary in lieu thereof. For the purpose of this clause, salary shall mean basic salary.</p>
            <p>10.2 You may terminate your employment with the Company, without any cause, by giving no less than [Employee Notice]</p>
            <p>months prior notice or salary for the unsaved period, left after adjustment of pending leaves, as on date.</p>
            <p>10.3 The Company reserves the right to terminate your employment summarily without any notice period or termination payment</p>
            <p>if it has reasonable ground to believe you are guilty of misconduct or negligence, or have committed any fundamental breach of</p>
            <p>contract, or caused any loss to the Company.</p>
            <p>10. 4 On the termination of your employment for whatever reason, you will return to the Company all property; documents, and</p>
            <p>paper, both original and copies thereof, including any samples, literature, contracts, records, lists, drawings, blueprints,</p>
            <p>letters, notes, data and the like; and Confidential Information, in your possession or under your control relating to your</p>
            <p>employment or to clients business affairs.</p>
            <p>11. Confidential Information</p>
            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>
            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>
            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>
            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>
            <p>Company.</p>
            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other</p>
            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>
            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>
            <p>the purposes of this clauseConfidential Information means information about the Companys business and that of its customers</p>
            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>
            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>
            <p>about the Companys products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,</p>
            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>
            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>
            <p>11.4 Your duty to safeguard and not disclos</p>
            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>
            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>
            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>
            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>
            <p>the address intimated by you in the official records.</p>
            <p>13. Applicability of Company Policy</p>
            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>
            <p>leave, employees benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>
            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that extent.</p>
            <p>14. Governing Law/Jurisdiction</p>
            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>
            <p>Gujarat only.</p>
            <p>15. Acceptance of our offer</p>
            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>
            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>
            <p>Yours Sincerely,</p>
            <p>{app_name}</p>
            <p>{date}</p>',
            'es' => '<h3 style="text-align: center;"><strong>Carta de uni&oacute;n</strong></h3>


            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>



            <p>Asunto: Nombramiento para el puesto de {designation}</p>



            <p>Estimado {employee_name},</p>

            <p>Nos complace ofrecerle el puesto de {designation} con {app_name}, la Compa&ntilde;&iacute;a en los siguientes t&eacute;rminos y</p>

            <p>condiciones:</p>


            <p>1. Comienzo del empleo</p>

            <p>Su empleo ser&aacute; efectivo a partir del {start_date}</p>


            <p>2. T&iacute;tulo del trabajo</p>
            <p>El t&iacute;tulo de su trabajo ser&aacute; {designation}.</p>

            <p>3. Salario</p>

            <p>Su salario y otros beneficios ser&aacute;n los establecidos en el Anexo 1 del presente.</p>


            <p>4. Lugar de destino</p>
            <p>Se le publicar&aacute; en {branch}. Sin embargo, es posible que deba trabajar en cualquier lugar de negocios que tenga la Compa&ntilde;&iacute;a, o</p>

            <p>puede adquirir posteriormente.</p>



            <p>5. Horas de trabajo</p>

            <p>Los d&iacute;as normales de trabajo son de lunes a viernes. Se le pedir&aacute; que trabaje las horas que sean necesarias para el</p>

            <p>cumplimiento adecuado de sus deberes para con la Compa&ntilde;&iacute;a. El horario normal de trabajo es de {start_time} a {end_time} y usted est&aacute;</p>

            <p>se espera que trabaje no menos de {total_hours} horas cada semana y, si es necesario, horas adicionales dependiendo de su</p>

            <p>responsabilidades.</p>



            <p>6. Licencia/Vacaciones</p>

            <p>6.1 Tiene derecho a un permiso eventual de 12 d&iacute;as.</p>

            <p>6.2 Tiene derecho a 12 d&iacute;as laborables de baja por enfermedad remunerada.</p>

            <p>6.3 La Compa&ntilde;&iacute;a deber&aacute; notificar una lista de d&iacute;as festivos declarados al comienzo de cada a&ntilde;o.</p>



            <p>7. Naturaleza de los deberes</p>

            <p>Desempe&ntilde;ar&aacute; lo mejor que pueda todas las funciones inherentes a su puesto y aquellas funciones adicionales que la empresa</p>

            <p>puede pedirte que act&uacute;es, de vez en cuando. Sus deberes espec&iacute;ficos se establecen en el Anexo II del presente.</p>



            <p>8. Propiedad de la empresa</p>

            <p>Siempre mantendr&aacute; en buenas condiciones la propiedad de la Compa&ntilde;&iacute;a, que se le puede confiar para uso oficial durante el curso de</p>

            <p>su empleo, y devolver&aacute; todos esos bienes a la Compa&ntilde;&iacute;a antes de renunciar a su cargo, en caso contrario, el costo</p>

            <p>de la misma ser&aacute; recuperada de usted por la Compa&ntilde;&iacute;a.</p>



            <p>9. Tomar prestado/aceptar regalos</p>

            <p>No pedir&aacute; prestado ni aceptar&aacute; dinero, obsequios, recompensas o compensaciones por sus ganancias personales o se colocar&aacute; de otra manera</p>

            <p>bajo obligaci&oacute;n pecuniaria a cualquier persona/cliente con quien pueda tener tratos oficiales.</p>
            <p>10. Terminaci&oacute;n</p>

            <p>10.1 Su nombramiento puede ser rescindido por la Compa&ntilde;&iacute;a, sin ning&uacute;n motivo, al darle no menos de [Aviso] meses antes</p>

            <p>aviso por escrito o salario en su lugar. Para los efectos de esta cl&aacute;usula, se entender&aacute; por salario el salario base.</p>

            <p>10.2 Puede rescindir su empleo con la Compa&ntilde;&iacute;a, sin ninguna causa, dando no menos de [Aviso al empleado]</p>

            <p>meses de preaviso o salario por el per&iacute;odo no ahorrado, remanente despu&eacute;s del ajuste de licencias pendientes, a la fecha.</p>

            <p>10.3 La Compa&ntilde;&iacute;a se reserva el derecho de rescindir su empleo sumariamente sin ning&uacute;n per&iacute;odo de preaviso o pago por rescisi&oacute;n</p>

            <p>si tiene motivos razonables para creer que usted es culpable de mala conducta o negligencia, o ha cometido una violaci&oacute;n fundamental de</p>

            <p>contrato, o causado cualquier p&eacute;rdida a la Compa&ntilde;&iacute;a.</p>

            <p>10. 4 A la terminaci&oacute;n de su empleo por cualquier motivo, devolver&aacute; a la Compa&ntilde;&iacute;a todos los bienes; documentos, y</p>

            <p>papel, tanto en original como en copia del mismo, incluyendo cualquier muestra, literatura, contratos, registros, listas, dibujos, planos,</p>

            <p>cartas, notas, datos y similares; e Informaci&oacute;n confidencial, en su posesi&oacute;n o bajo su control en relaci&oacute;n con su</p>

            <p>empleo o a los asuntos comerciales de los clientes.</p>
            <p>11. Informaci&oacute;n confidencial</p>

            <p>11. 1 Durante su empleo en la Compa&ntilde;&iacute;a, dedicar&aacute; todo su tiempo, atenci&oacute;n y habilidad lo mejor que pueda para</p>

            <p>son negocios. Usted no deber&aacute;, directa o indirectamente, comprometerse o asociarse con, estar conectado, interesado, empleado o</p>

            <p>tiempo o seguir cualquier curso de estudio, sin el permiso previo de la Compa&ntilde;&iacute;a. participar en cualquier otro negocio o</p>

            <p>actividades o cualquier otro puesto o trabajo a tiempo parcial o seguir cualquier curso de estudio, sin el permiso previo de la</p>

            <p>Compa&ntilde;&iacute;a.</p>

            <p>11.2 Siempre debe mantener el m&aacute;s alto grado de confidencialidad y mantener como confidenciales los registros, documentos y otros</p>

            <p>Informaci&oacute;n confidencial relacionada con el negocio de la Compa&ntilde;&iacute;a que usted pueda conocer o confiarle por cualquier medio</p>

            <p>y utilizar&aacute; dichos registros, documentos e informaci&oacute;n solo de manera debidamente autorizada en inter&eacute;s de la Compa&ntilde;&iacute;a. Para</p>

            <p>A los efectos de esta cl&aacute;usula, "Informaci&oacute;n confidencial" significa informaci&oacute;n sobre el negocio de la Compa&ntilde;&iacute;a y el de sus clientes.</p>

            <p>que no est&aacute; disponible para el p&uacute;blico en general y que usted puede aprender en el curso de su empleo. Esto incluye,</p>

            <p>pero no se limita a, informaci&oacute;n relacionada con la organizaci&oacute;n, sus listas de clientes, pol&iacute;ticas de empleo, personal e informaci&oacute;n</p>

            <p>sobre los productos de la Compa&ntilde;&iacute;a, procesos que incluyen ideas, conceptos, proyecciones, tecnolog&iacute;a, manuales, dibujos, dise&ntilde;os,</p>

            <p>especificaciones, y todos los papeles, curr&iacute;culos, registros y otros documentos que contengan dicha Informaci&oacute;n Confidencial.</p>

            <p>11.3 En ning&uacute;n momento, sacar&aacute; ninguna Informaci&oacute;n Confidencial de la oficina sin permiso.</p>

            <p>11.4 Su deber de salvaguardar y no divulgar</p>

            <p>La Informaci&oacute;n Confidencial sobrevivir&aacute; a la expiraci&oacute;n o terminaci&oacute;n de este Acuerdo y/o su empleo con la Compa&ntilde;&iacute;a.</p>

            <p>11.5 El incumplimiento de las condiciones de esta cl&aacute;usula le har&aacute; pasible de despido sumario en virtud de la cl&aacute;usula anterior adem&aacute;s de cualquier</p>

            <p>otro recurso que la Compa&ntilde;&iacute;a pueda tener contra usted por ley.</p>
            <p>12. Avisos</p>

            <p>Usted puede enviar notificaciones a la Compa&ntilde;&iacute;a a su domicilio social. La Compa&ntilde;&iacute;a puede enviarle notificaciones a usted en</p>

            <p>la direcci&oacute;n indicada por usted en los registros oficiales.</p>



            <p>13. Aplicabilidad de la pol&iacute;tica de la empresa</p>

            <p>La Compa&ntilde;&iacute;a tendr&aacute; derecho a hacer declaraciones de pol&iacute;tica de vez en cuando relacionadas con asuntos como el derecho a licencia, maternidad</p>

            <p>licencia, beneficios de los empleados, horas de trabajo, pol&iacute;ticas de transferencia, etc., y puede modificarlas de vez en cuando a su sola discreci&oacute;n.</p>

            <p>Todas las decisiones pol&iacute;ticas de la Compa&ntilde;&iacute;a ser&aacute;n vinculantes para usted y anular&aacute;n este Acuerdo en esa medida.</p>



            <p>14. Ley aplicable/Jurisdicci&oacute;n</p>

            <p>Su empleo con la Compa&ntilde;&iacute;a est&aacute; sujeto a las leyes del Pa&iacute;s. Todas las disputas estar&aacute;n sujetas a la jurisdicci&oacute;n del Tribunal Superior</p>

            <p>S&oacute;lo Gujarat.</p>



            <p>15. Aceptaci&oacute;n de nuestra oferta</p>

            <p>Por favor, confirme su aceptaci&oacute;n de este Contrato de Empleo firmando y devolviendo el duplicado.</p>



            <p>Le damos la bienvenida y esperamos recibir su aceptaci&oacute;n y trabajar con usted.</p>



            <p>Tuyo sinceramente,</p>

            <p>{app_name}</p>

            <p>{date}</p>',


            'fr' => '<h3 style="text-align: center;">Lettre dadh&eacute;sion</h3>


            <p>{date}</p>

            <p>{employee_name}</p>
            <p>{address}</p>


            <p>Objet : Nomination pour le poste de {designation}</p>



            <p>Cher {employee_name},</p>


            <p>Nous sommes heureux de vous proposer le poste de {designation} avec {app_name} la "Soci&eacute;t&eacute;" selon les conditions suivantes et</p>

            <p>les conditions:</p>

            <p>1. Entr&eacute;e en fonction</p>

            <p>Votre emploi sera effectif &agrave; partir du {start_date}</p>



            <p>2. Intitul&eacute; du poste</p>

            <p>Votre titre de poste sera {designation}.</p>



            <p>3. Salaire</p>

            <p>Votre salaire et vos autres avantages seront tels quindiqu&eacute;s &agrave; lannexe 1 ci-jointe.</p>


            <p>4. Lieu de d&eacute;tachement</p>
            <p>Vous serez affect&eacute; &agrave; {branch}. Vous pouvez cependant &ecirc;tre tenu de travailler dans nimporte quel lieu daffaires que la Soci&eacute;t&eacute; a, ou</p>

            <p>pourra acqu&eacute;rir plus tard.</p>



            <p>5. Heures de travail</p>

            <p>Les jours ouvrables normaux sont du lundi au vendredi. Vous devrez travailler les heures n&eacute;cessaires &agrave; la</p>

            <p>lexercice correct de vos fonctions envers la Soci&eacute;t&eacute;. Les heures normales de travail vont de {start_time} &agrave; {end_time} et vous &ecirc;tes</p>

            <p>devrait travailler au moins {total_hours} heures par semaine, et si n&eacute;cessaire des heures suppl&eacute;mentaires en fonction de votre</p>

            <p>responsabilit&eacute;s.</p>

            <p>6. Cong&eacute;s/Vacances</p>

            <p>6.1 Vous avez droit &agrave; un cong&eacute; occasionnel de 12 jours.</p>

            <p>6.2 Vous avez droit &agrave; 12 jours ouvrables de cong&eacute; de maladie pay&eacute;.</p>

            <p>6.3 La Soci&eacute;t&eacute; communiquera une liste des jours f&eacute;ri&eacute;s d&eacute;clar&eacute;s au d&eacute;but de chaque ann&eacute;e.</p>



            <p>7. Nature des fonctions</p>

            <p>Vous ex&eacute;cuterez au mieux de vos capacit&eacute;s toutes les t&acirc;ches inh&eacute;rentes &agrave; votre poste et les t&acirc;ches suppl&eacute;mentaires que lentreprise</p>

            <p>peut faire appel &agrave; vous pour effectuer, de temps &agrave; autre. Vos fonctions sp&eacute;cifiques sont &eacute;nonc&eacute;es &agrave; lannexe II ci-jointe.</p>



            <p>8. Biens sociaux</p>

            <p>Vous maintiendrez toujours en bon &eacute;tat les biens de la Soci&eacute;t&eacute;, qui peuvent vous &ecirc;tre confi&eacute;s pour un usage officiel au cours de votre</p>

            <p>votre emploi, et doit restituer tous ces biens &agrave; la Soci&eacute;t&eacute; avant labandon de votre charge, &agrave; d&eacute;faut de quoi le co&ucirc;t</p>

            <p>de m&ecirc;me seront r&eacute;cup&eacute;r&eacute;s aupr&egrave;s de vous par la Soci&eacute;t&eacute;.</p>



            <p>9. Emprunter/accepter des cadeaux</p>

            <p>Vous nemprunterez ni naccepterez dargent, de cadeau, de r&eacute;compense ou de compensation pour vos gains personnels ou vous placerez autrement</p>

            <p>sous obligation p&eacute;cuniaire envers toute personne/client avec qui vous pourriez avoir des relations officielles.</p>
            <p>10. R&eacute;siliation</p>

            <p>10.1 Votre nomination peut &ecirc;tre r&eacute;sili&eacute;e par la Soci&eacute;t&eacute;, sans aucune raison, en vous donnant au moins [Pr&eacute;avis] mois avant</p>

            <p>un pr&eacute;avis &eacute;crit ou un salaire en tenant lieu. Aux fins de la pr&eacute;sente clause, salaire sentend du salaire de base.</p>

            <p>10.2 Vous pouvez r&eacute;silier votre emploi au sein de la Soci&eacute;t&eacute;, sans motif, en donnant au moins [Avis &agrave; lemploy&eacute;]</p>

            <p>mois de pr&eacute;avis ou de salaire pour la p&eacute;riode non &eacute;pargn&eacute;e, restant apr&egrave;s r&eacute;gularisation des cong&eacute;s en attente, &agrave; la date.</p>

            <p>10.3 La Soci&eacute;t&eacute; se r&eacute;serve le droit de r&eacute;silier votre emploi sans pr&eacute;avis ni indemnit&eacute; de licenciement.</p>

            <p>sil a des motifs raisonnables de croire que vous &ecirc;tes coupable dinconduite ou de n&eacute;gligence, ou que vous avez commis une violation fondamentale de</p>

            <p>contrat, ou caus&eacute; une perte &agrave; la Soci&eacute;t&eacute;.</p>

            <p>10. 4 &Agrave; la fin de votre emploi pour quelque raison que ce soit, vous restituerez &agrave; la Soci&eacute;t&eacute; tous les biens ; document, et</p>

            <p>papier, &agrave; la fois loriginal et les copies de celui-ci, y compris les &eacute;chantillons, la litt&eacute;rature, les contrats, les dossiers, les listes, les dessins, les plans,</p>

            <p>lettres, notes, donn&eacute;es et similaires; et Informations confidentielles, en votre possession ou sous votre contr&ocirc;le relatives &agrave; votre</p>

            <p>lemploi ou aux affaires commerciales des clients.</p>
            <p>11. Informations confidentielles</p>

            <p>11. 1 Au cours de votre emploi au sein de la Soci&eacute;t&eacute;, vous consacrerez tout votre temps, votre attention et vos comp&eacute;tences au mieux de vos capacit&eacute;s pour</p>

            <p>son affaire. Vous ne devez pas, directement ou indirectement, vous engager ou vous associer &agrave;, &ecirc;tre li&eacute; &agrave;, concern&eacute;, employ&eacute; ou</p>

            <p>temps ou poursuivre quelque programme d&eacute;tudes que ce soit, sans lautorisation pr&eacute;alable de la Soci&eacute;t&eacute;. engag&eacute; dans toute autre entreprise ou</p>

            <p>activit&eacute;s ou tout autre poste ou travail &agrave; temps partiel ou poursuivre des &eacute;tudes quelconques, sans lautorisation pr&eacute;alable du</p>

            <p>Compagnie.</p>

            <p>11.2 Vous devez toujours maintenir le plus haut degr&eacute; de confidentialit&eacute; et garder confidentiels les dossiers, documents et autres</p>

            <p>Informations confidentielles relatives &agrave; lactivit&eacute; de la Soci&eacute;t&eacute; dont vous pourriez avoir connaissance ou qui vous seraient confi&eacute;es par tout moyen</p>

            <p>et vous nutiliserez ces registres, documents et informations que dune mani&egrave;re d&ucirc;ment autoris&eacute;e dans lint&eacute;r&ecirc;t de la Soci&eacute;t&eacute;. Pour</p>

            <p>aux fins de la pr&eacute;sente clause &laquo; Informations confidentielles &raquo; d&eacute;signe les informations sur les activit&eacute;s de la Soci&eacute;t&eacute; et celles de ses clients</p>

            <p>qui nest pas accessible au grand public et dont vous pourriez avoir connaissance dans le cadre de votre emploi. Ceci comprend,</p>

            <p>mais sans sy limiter, les informations relatives &agrave; lorganisation, ses listes de clients, ses politiques demploi, son personnel et les informations</p>

            <p>sur les produits, les processus de la Soci&eacute;t&eacute;, y compris les id&eacute;es, les concepts, les projections, la technologie, les manuels, les dessins, les conceptions,</p>

            <p>sp&eacute;cifications, et tous les papiers, curriculum vitae, dossiers et autres documents contenant de telles informations confidentielles.</p>

            <p>11.3 &Agrave; aucun moment, vous ne retirerez des informations confidentielles du bureau sans autorisation.</p>

            <p>11.4 Votre devoir de prot&eacute;ger et de ne pas divulguer</p>

            <p>Les Informations confidentielles survivront &agrave; lexpiration ou &agrave; la r&eacute;siliation du pr&eacute;sent Contrat et/ou &agrave; votre emploi au sein de la Soci&eacute;t&eacute;.</p>

            <p>11.5 La violation des conditions de cette clause vous rendra passible dun renvoi sans pr&eacute;avis en vertu de la clause ci-dessus en plus de tout</p>

            <p>autre recours que la Soci&eacute;t&eacute; peut avoir contre vous en droit.</p>
            <p>12. Avis</p>

            <p>Des avis peuvent &ecirc;tre donn&eacute;s par vous &agrave; la Soci&eacute;t&eacute; &agrave; ladresse de son si&egrave;ge social. Des avis peuvent vous &ecirc;tre donn&eacute;s par la Soci&eacute;t&eacute; &agrave;</p>

            <p>ladresse que vous avez indiqu&eacute;e dans les registres officiels.</p>



            <p>13. Applicabilit&eacute; de la politique de lentreprise</p>

            <p>La Soci&eacute;t&eacute; est autoris&eacute;e &agrave; faire des d&eacute;clarations de politique de temps &agrave; autre concernant des questions telles que le droit aux cong&eacute;s, la maternit&eacute;</p>

            <p>les cong&eacute;s, les avantages sociaux des employ&eacute;s, les heures de travail, les politiques de transfert, etc., et peut les modifier de temps &agrave; autre &agrave; sa seule discr&eacute;tion.</p>

            <p>Toutes ces d&eacute;cisions politiques de la Soci&eacute;t&eacute; vous lieront et pr&eacute;vaudront sur le pr&eacute;sent Contrat dans cette mesure.</p>



            <p>14. Droit applicable/juridiction</p>

            <p>Votre emploi au sein de la Soci&eacute;t&eacute; est soumis aux lois du pays. Tous les litiges seront soumis &agrave; la comp&eacute;tence du tribunal de grande instance</p>

            <p>Gujarat uniquement.</p>



            <p>15. Acceptation de notre offre</p>

            <p>Veuillez confirmer votre acceptation de ce contrat de travail en signant et en renvoyant le duplicata.</p>



            <p>Nous vous souhaitons la bienvenue et nous nous r&eacute;jouissons de recevoir votre acceptation et de travailler avec vous.</p>



            <p>Cordialement,</p>

            <p>{app_name}</p>

            <p>{date}</p>',


            'he' =>'<h3 style="text-align: center;">מכתב הצטרפות</h3>
            <p>{date}</p>
            <p>{employee_name}</p>
            <p>{address}</p>
            <p>נושא: מינוי לתפקיד של {designation}</p>
            <p>{employee_name} היקר,</p>
            <p>אנו שמחים להציע לך את התפקיד של {designation} ב-{app_name} theCompany בתנאים הבאים ו</p>
            <p>תנאים:</p>
            <p>1. תחילת עבודה</p>
            <p>העסקה שלך תיכנס לתוקף, החל מ-{start_date}</p>
            <p>2. כותרת תפקיד</p>
            <p>כותרת המשרה שלך תהיה {designation}.</p>
            <p>3. משכורת</p>
            <p>השכר וההטבות האחרות שלך יהיו כמפורט בתוספת 1, להלן.</p>
            <p>4. מקום הפרסום</p>
            <p>תפרסם ב-{branch}. עם זאת, ייתכן שתידרש לעבוד בכל מקום עסק שיש לחברה, או</p>
            <p>עשוי מאוחר יותר לרכוש.</p>
            <p>5. שעות עבודה</p>
            <p>ימי העבודה הרגילים הם שני עד שישי. תידרש לעבוד במשך שעות הדרושות ל</p>
            <p>מילוי נאות של חובותיך כלפי החברה. שעות העבודה הרגילות הן מ-{start_time} עד {end_time} ואתה</p>
            <p>צפוי לעבוד לא פחות מ-{total_hours} שעות בכל שבוע, ובמידת הצורך לשעות נוספות בהתאם ל</p>
            <p>אחריות.</p>
            <p>6. עזוב/חגים</p>
            <p>6.1 אתה זכאי לחופשה מזדמנת של 12 ימים.</p>
            <p>6.2 אתה זכאי ל-12 ימי עבודה של חופשת מחלה בתשלום.</p>
            <p>6.3 החברה תודיע על רשימה של חגים מוכרזים בתחילת כל שנה.</p>
            <p>7. אופי התפקידים</p>
            <p>תבצע כמיטב יכולתך את כל החובות הגלומות בתפקידך וחובות נוספות כמו החברה</p>
            <p>עשוי לקרוא לך להופיע, מעת לעת. החובות הספציפיות שלך מפורטות בנספח II להלן.</p>
            <p>8. נכס החברה</p>
            <p>תמיד תשמור על רכוש החברה במצב טוב, אשר עשוי להיות מופקד בידיך לשימוש רשמי במהלך</p>
            <p>העסקתך, ותחזיר את כל הרכוש כאמור לחברה לפני ויתור על החיוב שלך, אם לא העלות</p>
            <p>של אותו החברה יגבה ממך.</p>
            <p>9. השאלת/קבלת מתנות</p>
            <p>לא תלווה או תקבל שום כסף, מתנה, תגמול או פיצוי עבור הרווחים האישיים שלך מעצמך או למקם את עצמך בדרך אחרת</p>
            <p>תחת התחייבות כספית לכל אדם/לקוח שעמו אתה מקיים עסקאות רשמיות.</p>
            <p>10. סיום</p>
            <p>10.1 החברה יכולה לסיים את המינוי שלך, ללא כל סיבה, על ידי מתן הודעה לא פחות מ[הודעה] חודשים לפני</p>
            <p>הודעה בכתב או שכר במקום. לעניין סעיף זה, שכר פירושו שכר יסוד.</p>
            <p>10.2 אתה רשאי לסיים את העסקתך בחברה, ללא כל סיבה, על ידי מתן לא פחות מ[הודעת עובד]</p>
            <p>הודעה מוקדמת של חודשים או משכורת לתקופה שלא נשמרה, שנותרה לאחר התאמה של חופשות ממתינות, כמו בתאריך.</p>
            <p>10.3 החברה שומרת לעצמה את הזכות לסיים את העסקתך באופן סופי ללא כל תקופת הודעה מוקדמת או תשלום פיטורין</p>
            <p>אם יש לו יסוד סביר להאמין שאתה אשם בהתנהגות בלתי הולמת או ברשלנות, או שביצעת הפרה יסודית כלשהי של</p>
            <p>חוזה, או גרם להפסד כלשהו לחברה.</p>
            <p>10. 4 עם סיום העסקתך מכל סיבה שהיא, תחזיר לחברה את כל הרכוש; מסמכים ו</p>
            <p>נייר, הן במקור והן בהעתקים שלו, כולל כל דוגמאות, ספרות, חוזים, רשומות, רשימות, שרטוטים, שרטוטים,</p>
            <p>מכתבים, הערות, נתונים וכדומה; ומידע סודי, ברשותך או בשליטתך, הקשור ל</p> שלך
            <p>תעסוקה או עניינים עסקיים ללקוחות.</p>
            <p>11. מידע סודי</p>
            <p>11. 1 במהלך עבודתך בחברה תקדיש את כל זמנך, תשומת הלב והמיומנות שלך כמיטב יכולתך ל</p>
            <p>העסק שלה. לא, במישרין או בעקיפין, לא תתקשר או תקשר את עצמך, תהיה קשור, מודאג, מועסק, או</p>
            <p>זמן או להמשיך כל מסלול לימודים שהוא, ללא אישור מראש של החברה. עוסק בכל עסק אחר או</p>
            <p>פעילויות או כל משרה אחרת או עבודה במשרה חלקית או להמשיך בכל מסלול לימודים שהוא, ללא אישור מראש של</p>
            <p>חברה.</p>
            <p>11.2 עליך לשמור תמיד על רמת הסודיות הגבוהה ביותר ולשמור בסודיות את הרשומות, המסמכים ואחרים</p>
            <p>מידע סודי המתייחס לעסקים של החברה שעשוי להיות ידוע לך או נסוב לך בכל אמצעי</p>
            <p>ותשתמש ברשומות, במסמכים ובמידע כאמור רק באופן מורשה כדין לטובת החברה. עבור</p>
            <p>מטרות סעיף זה מידע סודי פירושה מידע על עסקי החברה ושל לקוחותיה</p>
            <p>אשר אינו זמין לציבור הרחב ואשר עשוי ללמוד על ידך במהלך העסקתך. זה כולל,</p>
            <p>אך לא מוגבל למידע הנוגע לארגון, רשימות הלקוחות שלו, מדיניות העסקה, כוח אדם ומידע</p>
            <p>על מוצרי החברה, תהליכים, כולל רעיונות, מושגים, תחזיות, טכנולוגיה, מדריכים, שרטוט, עיצובים,</p>
            <p>מפרטים וכל הניירות, קורות החיים, הרשומות ומסמכים אחרים המכילים מידע סודי כזה.</p>
            <p>11.3 בשום זמן לא תסיר כל מידע סודי מהמשרד ללא רשות.</p>
            <p>11.4 חובתך לשמור ולא לחשוף</p>
            <p>המידע הסודי ישרוד את תפוגה או סיומו של הסכם זה ו/או העסקתך בחברה.</p>
            <p>11.5 הפרת התנאים של סעיף זה תגרום לך לחייב אותך לפיטורים על הסף על פי הסעיף לעיל בנוסף לכל</p>
            <p>סעד אחר שעשויה להיות לחברה נגדך בחוק.</p>
            <p>12. הודעות</p>
            <p>ייתכן שתמסרו הודעות לחברה בכתובת המשרד הרשום שלה. ייתכן שהחברה תמסור לך הודעות בכתובת</p>
            <p>הכתובת שציינת ברשומות הרשמיות.</p>
            <p>13. תחולת מדיניות החברה</p>
            <p>החברה תהיה רשאית להצהיר מעת לעת הצהרות מדיניות הנוגעות לעניינים כמו זכאות לחופשה, לידה</p>
            <p>עזיבה, הטבות לעובדים, שעות עבודה, מדיניות העברה וכו, ועשויות לשנות את אותם מעת לעת לפי שיקול דעתה הבלעדי.</p>
            <p>כל החלטות המדיניות הללו של החברה יחייבו אותך ויעקפו את הסכם זה במידה זו.</p>
            <p>14. חוק חל/תחום שיפוט</p>
            <p>העסקתך בחברה כפופה לחוקי המדינה. כל המחלוקות יהיו כפופות לסמכות השיפוט של בית המשפט העליון</p>
            <p>גוג אראט בלבד.</p>
            <p>15. קבלת ההצעה שלנו</p>
            <p>אנא אשר את הסכמתך לחוזה העסקה זה על ידי חתימה והחזרת העותק הכפול.</p>
            <p>אנו מברכים אותך ומצפים לקבל את הסכמתך ולעבוד איתך.</p>
            <p>בכבוד רב,</p>
            <p>{app_name}</p>

            <p>{date}</p>',

            'it' => '<h3 style="text-align: center;">Lettera di adesione</h3>


            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>

            <p>Oggetto: Appuntamento alla carica di {designation}</p>


            <p>Gentile {employee_name},</p>

            <p>Siamo lieti di offrirti la posizione di {designation} con {app_name} la "Societ&agrave;" alle seguenti condizioni e</p>

            <p>condizioni:</p>


            <p>1. Inizio del rapporto di lavoro</p>

            <p>Il tuo impiego sar&agrave; effettivo a partire da {start_date}</p>



            <p>2. Titolo di lavoro</p>

            <p>Il tuo titolo di lavoro sar&agrave; {designation}.</p>

            <p>3. Stipendio</p>

            <p>Il tuo stipendio e altri benefici saranno come indicato nellAllegato 1, qui di seguito.</p>



            <p>4. Luogo di invio</p>

            <p>Sarai inviato a {branch}. Tuttavia, potrebbe essere richiesto di lavorare in qualsiasi luogo di attivit&agrave; che la Societ&agrave; ha, o</p>

            <p>potr&agrave; successivamente acquisire.</p>



            <p>5. Orario di lavoro</p>

            <p>I normali giorni lavorativi sono dal luned&igrave; al venerd&igrave;. Ti verr&agrave; richiesto di lavorare per le ore necessarie per il</p>

            <p>corretto adempimento dei propri doveri nei confronti della Societ&agrave;. Lorario di lavoro normale va da {start_time} a {end_time} e tu lo sei</p>

            <p>dovrebbe lavorare non meno di {total_hours} ore ogni settimana e, se necessario, per ore aggiuntive a seconda del tuo</p>

            <p>responsabilit&agrave;.</p>



            <p>6. Permessi/Festivit&agrave;</p>

            <p>6.1 Hai diritto a un congedo occasionale di 12 giorni.</p>

            <p>6.2 Hai diritto a 12 giorni lavorativi di congedo per malattia retribuito.</p>

            <p>6.3 La Societ&agrave; comunica allinizio di ogni anno un elenco delle festivit&agrave; dichiarate.</p>



            <p>7. Natura degli incarichi</p>

            <p>Eseguirai al meglio delle tue capacit&agrave; tutti i compiti inerenti al tuo incarico e compiti aggiuntivi come lazienda</p>

            <p>pu&ograve; invitarti a esibirti, di tanto in tanto. I tuoi doveri specifici sono stabiliti nellAllegato II del presente documento.</p>



            <p>8. Propriet&agrave; aziendale</p>

            <p>Manterrete sempre in buono stato i beni dellAzienda, che nel corso dellanno potrebbero esservi affidati per uso ufficiale</p>

            <p>il tuo impiego, e restituir&agrave; tutte queste propriet&agrave; alla Societ&agrave; prima della rinuncia al tuo addebito, in caso contrario il costo</p>

            <p>degli stessi saranno da voi recuperati dalla Societ&agrave;.</p>



            <p>9. Prendere in prestito/accettare regali</p>

            <p>Non prenderai in prestito n&eacute; accetterai denaro, dono, ricompensa o compenso per i tuoi guadagni personali da o altrimenti collocato te stesso</p>

            <p>sotto obbligazione pecuniaria nei confronti di qualsiasi persona/cliente con cui potresti avere rapporti ufficiali.</p>
            <p>10. Cessazione</p>

            <p>10.1 Il tuo incarico pu&ograve; essere risolto dalla Societ&agrave;, senza alcun motivo, dandoti non meno di [Avviso] mesi prima</p>

            <p>avviso scritto o stipendio in sostituzione di esso. Ai fini della presente clausola, per stipendio si intende lo stipendio base.</p>

            <p>10.2 &Egrave; possibile terminare il proprio rapporto di lavoro con la Societ&agrave;, senza alcuna causa, fornendo non meno di [Avviso per il dipendente]</p>

            <p>mesi di preavviso o stipendio per il periodo non risparmiato, lasciato dopo ladeguamento delle ferie pendenti, come alla data.</p>

            <p>10.3 La Societ&agrave; si riserva il diritto di terminare il rapporto di lavoro sommariamente senza alcun periodo di preavviso o pagamento di cessazione</p>

            <p>se ha fondati motivi per ritenere che tu sia colpevole di cattiva condotta o negligenza, o abbia commesso una violazione fondamentale</p>

            <p>contratto, o ha causato danni alla Societ&agrave;.</p>

            <p>10. 4 Alla cessazione del rapporto di lavoro per qualsiasi motivo, restituirete alla Societ&agrave; tutti i beni; documenti, e</p>

            <p>carta, sia in originale che in copia, inclusi eventuali campioni, letteratura, contratti, registrazioni, elenchi, disegni, progetti,</p>

            <p>lettere, note, dati e simili; e Informazioni Riservate, in tuo possesso o sotto il tuo controllo, relative alla tua</p>

            <p>lavoro o agli affari dei clienti.</p>
            <p>11. Confidential Information</p>

            <p>11. 1 During your employment with the Company you will devote your whole time, attention, and skill to the best of your ability for</p>

            <p>its business. You shall not, directly or indirectly, engage or associate yourself with, be connected with, concerned, employed, or</p>

            <p>time or pursue any course of study whatsoever, without the prior permission of the Company.engaged in any other business or</p>

            <p>activities or any other post or work part-time or pursue any course of study whatsoever, without the prior permission of the</p>

            <p>Company.</p>

            <p>11.2 You must always maintain the highest degree of confidentiality and keep as confidential the records, documents, and other&nbsp;</p>

            <p>Confidential Information relating to the business of the Company which may be known to you or confided in you by any means</p>

            <p>and you will use such records, documents and information only in a duly authorized manner in the interest of the Company. For</p>

            <p>the purposes of this clause &lsquo;Confidential Information&rsquo; means information about the Company&rsquo;s business and that of its customers</p>

            <p>which is not available to the general public and which may be learned by you in the course of your employment. This includes,</p>

            <p>but is not limited to, information relating to the organization, its customer lists, employment policies, personnel, and information</p>

            <p>about the Company&rsquo;s products, processes including ideas, concepts, projections, technology, manuals, drawing, designs,&nbsp;</p>

            <p>specifications, and all papers, resumes, records and other documents containing such Confidential Information.</p>

            <p>11.3 At no time, will you remove any Confidential Information from the office without permission.</p>

            <p>11.4 Your duty to safeguard and not disclos</p>

            <p>e Confidential Information will survive the expiration or termination of this Agreement and/or your employment with the Company.</p>

            <p>11.5 Breach of the conditions of this clause will render you liable to summary dismissal under the clause above in addition to any</p>

            <p>other remedy the Company may have against you in law.</p>
            <p>12. Notices</p>

            <p>Notices may be given by you to the Company at its registered office address. Notices may be given by the Company to you at</p>

            <p>the address intimated by you in the official records.</p>



            <p>13. Applicability of Company Policy</p>

            <p>The Company shall be entitled to make policy declarations from time to time pertaining to matters like leave entitlement,maternity</p>

            <p>leave, employees&rsquo; benefits, working hours, transfer policies, etc., and may alter the same from time to time at its sole discretion.</p>

            <p>All such policy decisions of the Company shall be binding on you and shall override this Agreement to that&nbsp; extent.</p>



            <p>14. Governing Law/Jurisdiction</p>

            <p>Your employment with the Company is subject to Country laws. All disputes shall be subject to the jurisdiction of High Court</p>

            <p>Gujarat only.</p>



            <p>15. Acceptance of our offer</p>

            <p>Please confirm your acceptance of this Contract of Employment by signing and returning the duplicate copy.</p>



            <p>We welcome you and look forward to receiving your acceptance and to working with you.</p>



            <p>Yours Sincerely,</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'ja' => '<h3 style="text-align: center;">入会の手紙</h3>

            <p>{date}</p>

            <p>{employee_name}</p>

            <p>{address}</p>

            <p>件名: {designation} の役職への任命</p>

            <p>{employee_name} 様</p>

            <p>{app_name} の {designation} の地位を以下の条件で「会社」として提供できることをうれしく思います。</p>

            <p>条件：</p>

            <p>1. 雇用開始</p>

            <p>あなたの雇用は {start_date} から有効になります</p>


            <p>2. 役職</p>

            <p>あなたの役職は{designation}になります。</p>


            <p>3. 給与</p>

            <p>あなたの給与およびその他の福利厚生は、本明細書のスケジュール 1 に記載されているとおりです。</p>


            <p>4. 掲示場所</p>

            <p>{branch} に掲載されます。ただし、会社が所有する事業所で働く必要がある場合があります。</p>

            <p>後で取得する場合があります。</p>



            <p>5. 労働時間</p>

            <p>通常の営業日は月曜日から金曜日です。あなたは、そのために必要な時間働く必要があります。</p>

            <p>会社に対するあなたの義務の適切な遂行。通常の勤務時間は {start_time} から {end_time} までで、あなたは</p>

            <p>毎週 {total_hours} 時間以上の勤務が期待される</p>

            <p>責任。</p>



            <p>6.休暇・休日</p>

            <p>6.1 12 日間の臨時休暇を取得する権利があります。</p>

            <p>6.2 12 日間の有給病気休暇を取る権利があります。</p>

            <p>6.3 当社は、毎年の初めに宣言された休日のリストを通知するものとします。</p>



            <p>7. 職務内容</p>

            <p>あなたは、自分のポストに固有のすべての義務と、会社としての追加の義務を最大限に遂行します。</p>

            <p>時々あなたに演奏を依頼するかもしれません。あなたの特定の義務は、本明細書のスケジュール II に記載されています。</p>



            <p>8. 会社財産</p>

            <p>あなたは、会社の所有物を常に良好な状態に維持するものとします。</p>

            <p>あなたの雇用を放棄し、あなたの料金を放棄する前に、そのようなすべての財産を会社に返還するものとします。</p>

            <p>同じのは、会社によってあなたから回収されます。</p>



            <p>9. 貸出・贈答品の受け取り</p>

            <p>あなたは、あなた自身から、または他の方法であなた自身の場所から個人的な利益を得るための金銭、贈り物、報酬、または補償を借りたり、受け取ったりしません。</p>

            <p>あなたが公式の取引をしている可能性のある人物/クライアントに対する金銭的義務の下で。</p>
            <p>10. 終了</p>

            <p>10.1 少なくとも [通知] か月前に通知することにより、理由のいかんを問わず、会社はあなたの任命を終了することができます。</p>

            <p>書面による通知またはその代わりの給与。この条項の目的上、給与とは基本給を意味するものとします。</p>

            <p>10.2 あなたは、少なくとも [従業員通知] を提出することにより、理由のいかんを問わず、会社での雇用を終了することができます。</p>

            <p>保留中の休暇の調整後に残された、保存されていない期間の数か月前の通知または給与は、日付のとおりです。</p>

            <p>10.3 当社は、通知期間や解雇補償金なしに、あなたの雇用を即座に終了させる権利を留保します。</p>

            <p>あなたが不正行為または過失で有罪であると信じる合理的な根拠がある場合、または基本的な違反を犯した場合</p>

            <p>契約、または当社に損害を与えた。</p>

            <p>10. 4 何らかの理由で雇用が終了した場合、あなたは会社にすべての財産を返還するものとします。ドキュメント、および</p>

            <p>サンプル、文献、契約書、記録、リスト、図面、青写真を含む、原本とコピーの両方の紙、</p>

            <p>手紙、メモ、データなど。あなたが所有する、またはあなたの管理下にある機密情報。</p>

            <p>雇用またはクライアントの業務に。</p>
            <p>11. 機密情報</p>

            <p>11. 1 当社での雇用期間中、あなたは自分の全時間、注意、およびスキルを、自分の能力の限りを尽くして捧げます。</p>

            <p>そのビジネス。あなたは、直接的または間接的に、関与したり、関連付けたり、接続したり、関係したり、雇用したり、または</p>

            <p>会社の事前の許可なしに、時間や学習コースを追求すること。他のビジネスに従事すること、または</p>

            <p>の事前の許可なしに、活動またはその他の投稿またはアルバイトをしたり、何らかの研究コースを追求したりすること。</p>

            <p>会社。</p>

            <p>11.2 常に最高度の機密性を維持し、記録、文書、およびその他の情報を機密として保持する必要があります。</p>

            <p>お客様が知っている、または何らかの方法でお客様に内密にされている可能性がある、当社の事業に関連する機密情報</p>

            <p>また、あなたは、会社の利益のために正当に承認された方法でのみ、そのような記録、文書、および情報を使用するものとします。為に</p>

            <p>この条項の目的 「機密情報」とは、会社の事業および顧客の事業に関する情報を意味します。</p>

            <p>これは一般には公開されておらず、雇用の過程で学習する可能性があります。これも、</p>

            <p>組織、その顧客リスト、雇用方針、人事、および情報に関連する情報に限定されません</p>

            <p>当社の製品、アイデアを含むプロセス、コンセプト、予測、技術、マニュアル、図面、デザイン、</p>

            <p>仕様、およびそのような機密情報を含むすべての書類、履歴書、記録、およびその他の文書。</p>

            <p>11.3 いかなる時も、許可なくオフィスから機密情報を削除しないでください。</p>

            <p>11.4 保護し、開示しないというあなたの義務</p>

            <p>e 機密情報は、本契約および/または当社との雇用の満了または終了後も存続します。</p>

            <p>11.5 この条項の条件に違反した場合、上記の条項に基づく略式解雇の対象となります。</p>

            <p>会社が法律であなたに対して持つことができるその他の救済。</p>
            <p>12. 通知</p>

            <p>通知は、登録された事務所の住所で会社に提出することができます。通知は、当社からお客様に提供される場合があります。</p>

            <p>公式記録であなたがほのめかした住所。</p>



            <p>13. 会社方針の適用性</p>

            <p>会社は、休暇の資格、出産などの事項に関して、随時方針を宣言する権利を有するものとします。</p>

            <p>休暇、従業員の福利厚生、勤務時間、異動ポリシーなどであり、独自の裁量により随時変更される場合があります。</p>

            <p>当社のそのようなポリシー決定はすべて、あなたを拘束し、その範囲で本契約を無効にするものとします。</p>



            <p>14. 準拠法・裁判管轄</p>

            <p>当社でのあなたの雇用は、国の法律の対象となります。すべての紛争は、高等裁判所の管轄に服するものとします</p>

            <p>グジャラートのみ。</p>



            <p>15. オファーの受諾</p>

            <p>副本に署名して返送することにより、この雇用契約に同意したことを確認してください。</p>



            <p>私たちはあなたを歓迎し、あなたの受け入れを受け取り、あなたと一緒に働くことを楽しみにしています.</p>



            <p>敬具、</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'nl' => '<h3 style="text-align: center;">Deelnemende brief</h3>

            <p>{date}</p>

            <p>{employee}</p>

            <p>{address}</p>

            <p>Onderwerp: Benoeming voor de functie van {designation}</p>

            <p>Beste {employee_name},</p>

            <p>We zijn verheugd u de positie van {designation} bij {app_name} het Bedrijf aan te bieden onder de volgende voorwaarden en</p>

            <p>conditie:</p>


            <p>1. Indiensttreding</p>
            <p>Uw dienstverband gaat in op {start_date}</p>


            <p>2. Functietitel</p>

            <p>Uw functietitel wordt {designation}.</p>

            <p>3. Salaris</p>

            <p>Uw salaris en andere voordelen zijn zoals uiteengezet in Schema 1 hierbij.</p>

            <p>4. Plaats van detachering</p>

            <p>Je wordt geplaatst op {branch}. Het kan echter zijn dat u moet werken op een bedrijfslocatie die het Bedrijf heeft, of</p>

            <p>later kan verwerven.</p>



            <p>5. Werkuren</p>

            <p>De normale werkdagen zijn van maandag tot en met vrijdag. Je zal de uren moeten werken die nodig zijn voor de</p>

            <p>correcte uitvoering van uw taken jegens het bedrijf. De normale werkuren zijn van {start_time} tot {end_time} en jij bent</p>

            <p>naar verwachting niet minder dan {total_hours} uur per week werken, en indien nodig voor extra uren, afhankelijk van uw</p>

            <p>verantwoordelijkheden.</p>



            <p>6. Verlof/Vakantie</p>

            <p>6.1 Je hebt recht op tijdelijk verlof van 12 dagen.</p>

            <p>6.2 U heeft recht op 12 werkdagen betaald ziekteverlof.</p>

            <p>6.3 De Maatschappij stelt aan het begin van elk jaar een lijst van verklaarde feestdagen op.</p>



            <p>7. Aard van de taken</p>

            <p>Je voert alle taken die inherent zijn aan je functie en bijkomende taken zoals het bedrijf naar beste vermogen uit;</p>

            <p>kan van tijd tot tijd een beroep op u doen om op te treden. Uw specifieke taken zijn uiteengezet in Bijlage II hierbij.</p>



            <p>8. Bedrijfseigendommen</p>

            <p>U onderhoudt bedrijfseigendommen, die u in de loop van</p>

            <p>uw dienstverband, en zal al deze eigendommen aan het Bedrijf teruggeven voordat afstand wordt gedaan van uw kosten, bij gebreke waarvan de kosten</p>

            <p>hiervan zal door het Bedrijf van u worden verhaald.</p>



            <p>9. Geschenken lenen/aannemen</p>

            <p>U zult geen geld, geschenken, beloningen of vergoedingen voor uw persoonlijk gewin lenen of accepteren van uzelf of uzelf op een andere manier plaatsen</p>

            <p>onder geldelijke verplichting jegens een persoon/klant met wie u mogelijk offici&euml;le betrekkingen heeft.</p>
            <p>10. Be&euml;indiging</p>

            <p>10.1 Uw aanstelling kan door het Bedrijf zonder opgaaf van reden worden be&euml;indigd door u minimaal [Opzegging] maanden van tevoren</p>

            <p>schriftelijke opzegging of daarvoor in de plaats komend salaris. In dit artikel wordt onder salaris verstaan ​​het basissalaris.</p>

            <p>10.2 U kunt uw dienstverband bij het Bedrijf be&euml;indigen, zonder enige reden, door niet minder dan [Mededeling van de werknemer]</p>

            <p>maanden opzegtermijn of salaris voor de niet gespaarde periode, overgebleven na aanpassing van hangende verlofdagen, zoals op datum.</p>

            <p>10.3 Het bedrijf behoudt zich het recht voor om uw dienstverband op staande voet te be&euml;indigen zonder enige opzegtermijn of be&euml;indigingsvergoeding</p>

            <p>als het redelijke grond heeft om aan te nemen dat u zich schuldig heeft gemaakt aan wangedrag of nalatigheid, of een fundamentele schending van</p>

            <p>contract, of enig verlies voor het Bedrijf veroorzaakt.</p>

            <p>10. 4 Bij be&euml;indiging van uw dienstverband om welke reden dan ook, geeft u alle eigendommen terug aan het Bedrijf; documenten, en</p>

            <p>papier, zowel origineel als kopie&euml;n daarvan, inclusief eventuele monsters, literatuur, contracten, bescheiden, lijsten, tekeningen, blauwdrukken,</p>

            <p>brieven, notities, gegevens en dergelijke; en Vertrouwelijke informatie, in uw bezit of onder uw controle met betrekking tot uw</p>

            <p>werkgelegenheid of de zakelijke aangelegenheden van klanten.</p>
            <p>11. Vertrouwelijke informatie</p>

            <p>11. 1 Tijdens uw dienstverband bij het Bedrijf besteedt u al uw tijd, aandacht en vaardigheden naar uw beste vermogen aan:</p>

            <p>zijn zaken. U mag zich niet, direct of indirect, inlaten met of verbonden zijn met, betrokken zijn bij, betrokken zijn bij, in dienst zijn van of</p>

            <p>tijd doorbrengen of een studie volgen, zonder voorafgaande toestemming van het bedrijf.bezig met een ander bedrijf of</p>

            <p>werkzaamheden of enige andere functie of werk in deeltijd of het volgen van welke opleiding dan ook, zonder voorafgaande toestemming van de</p>

            <p>Bedrijf.</p>

            <p>11.2 U moet altijd de hoogste graad van vertrouwelijkheid handhaven en de records, documenten en andere</p>

            <p>Vertrouwelijke informatie met betrekking tot het bedrijf van het bedrijf die u op enigerlei wijze bekend is of in vertrouwen is genomen</p>

            <p>en u zult dergelijke records, documenten en informatie alleen gebruiken op een naar behoren gemachtigde manier in het belang van het bedrijf. Voor</p>

            <p>de doeleinden van deze clausule Vertrouwelijke informatiebetekent informatie over het bedrijf van het bedrijf en dat van zijn klanten</p>

            <p>die niet beschikbaar is voor het grote publiek en die u tijdens uw dienstverband kunt leren. Dit bevat,</p>

            <p>maar is niet beperkt tot informatie met betrekking tot de organisatie, haar klantenlijsten, werkgelegenheidsbeleid, personeel en informatie</p>

            <p>over de producten, processen van het bedrijf, inclusief idee&euml;n, concepten, projecties, technologie, handleidingen, tekeningen, ontwerpen,</p>

            <p>specificaties, en alle papieren, cvs, dossiers en andere documenten die dergelijke vertrouwelijke informatie bevatten.</p>

            <p>11.3 U verwijdert nooit vertrouwelijke informatie van het kantoor zonder toestemming.</p>

            <p>11.4 Uw plicht om te beschermen en niet openbaar te maken</p>

            <p>e Vertrouwelijke informatie blijft van kracht na het verstrijken of be&euml;indigen van deze Overeenkomst en/of uw dienstverband bij het Bedrijf.</p>

            <p>11.5 Schending van de voorwaarden van deze clausule maakt u aansprakelijk voor ontslag op staande voet op grond van de bovenstaande clausule, naast eventuele:</p>

            <p>ander rechtsmiddel dat het Bedrijf volgens de wet tegen u heeft.</p>
            <p>12. Kennisgevingen</p>

            <p>Kennisgevingen kunnen door u aan het Bedrijf worden gedaan op het adres van de maatschappelijke zetel. Kennisgevingen kunnen door het bedrijf aan u worden gedaan op:</p>

            <p>het door u opgegeven adres in de offici&euml;le administratie.</p>



            <p>13. Toepasselijkheid van het bedrijfsbeleid</p>

            <p>Het bedrijf heeft het recht om van tijd tot tijd beleidsverklaringen af ​​te leggen met betrekking tot zaken als verlofrecht, moederschap</p>

            <p>verlof, werknemersvoordelen, werkuren, transferbeleid, enz., en kan deze van tijd tot tijd naar eigen goeddunken wijzigen.</p>

            <p>Al dergelijke beleidsbeslissingen van het Bedrijf zijn bindend voor u en hebben voorrang op deze Overeenkomst in die mate.</p>



            <p>14. Toepasselijk recht/jurisdictie</p>

            <p>Uw dienstverband bij het bedrijf is onderworpen aan de landelijke wetgeving. Alle geschillen zijn onderworpen aan de jurisdictie van de High Court</p>

            <p>Alleen Gujarat.</p>



            <p>15. Aanvaarding van ons aanbod</p>

            <p>Bevestig uw aanvaarding van deze arbeidsovereenkomst door het duplicaat te ondertekenen en terug te sturen.</p>



            <p>Wij heten u van harte welkom en kijken ernaar uit uw acceptatie te ontvangen en met u samen te werken.</p>



            <p>Hoogachtend,</p>

            <p>{app_name}</p>

            <p>{date}</p>',

            'pl' => '<h3 style="text-align: center;">Dołączanie listu</h3>

            <p>{date }</p>

            <p>{employee_name }</p>

            <p>{address }</p>


            <p>Dotyczy: mianowania na stanowisko {designation}</p>

            <p>Szanowny {employee_name },</p>

            <p>Mamy przyjemność zaoferować Państwu, stanowisko {designation} z {app_name } "Sp&oacute;łka" na poniższych warunkach i</p>
            <p>warunki:</p>

            <p>1. Rozpoczęcie pracy</p>

            <p>Twoje zatrudnienie będzie skuteczne, jak na {start_date }</p>

            <p>2. Tytuł zadania</p>
            <p>Tw&oacute;j tytuł pracy to {designation}.</p>

            <p>3. Salary</p>

            <p>Twoje wynagrodzenie i inne świadczenia będą określone w Zestawieniu 1, do niniejszego rozporządzenia.</p>


            <p>4. Miejsce delegowania</p>
            <p>Użytkownik zostanie opublikowany w {branch }. Użytkownik może jednak być zobowiązany do pracy w dowolnym miejscu prowadzenia działalności, kt&oacute;re Sp&oacute;łka posiada, lub może p&oacute;źniej nabyć.</p>

            <p>5. Godziny pracy</p>
            <p>Normalne dni robocze są od poniedziałku do piątku. Będziesz zobowiązany do pracy na takie godziny, jakie są niezbędne do prawidłowego wywiązania się ze swoich obowiązk&oacute;w wobec Sp&oacute;łki. Normalne godziny pracy to {start_time } do {end_time }, a użytkownik oczekuje, że będzie pracować nie mniej niż {total_hours } godzin tygodniowo, a jeśli to konieczne, przez dodatkowe godziny w zależności od Twojego</p>
            <p>odpowiedzialności.</p>

            <p>6. Urlop/Wakacje</p>

            <p>6.1 Przysługuje prawo do urlopu dorywczego w ciągu 12 dni.</p>

            <p>6.2 Użytkownik ma prawo do 12 dni roboczych od wypłatnego zwolnienia chorobowego.</p>

            <p>6.3 Sp&oacute;łka powiadamia na początku każdego roku wykaz ogłoszonych świąt.&nbsp;</p>



            <p>7. Rodzaj obowiązk&oacute;w</p>

            <p>Będziesz wykonywać na najlepsze ze swojej zdolności wszystkie obowiązki, jak są one nieodłączne w swoim poście i takie dodatkowe obowiązki, jak firma może zadzwonić do wykonania, od czasu do czasu. Państwa szczeg&oacute;lne obowiązki są określone w załączniku II do niniejszego rozporządzenia.</p>



            <p>8. Właściwość przedsiębiorstwa</p>

            <p>Zawsze będziesz utrzymywać w dobrej kondycji Firmy, kt&oacute;ra może być powierzona do użytku służbowego w trakcie trwania</p>

            <p>Twoje zatrudnienie, i zwr&oacute;ci wszystkie takie nieruchomości do Sp&oacute;łki przed zrzeczeniem się opłaty, w przeciwnym razie koszty te same będą odzyskane od Ciebie przez Sp&oacute;łkę.</p>

            <p>9. Wypożyczanie/akceptowanie prezent&oacute;w</p>

            <p>Nie będziesz pożyczał ani nie akceptować żadnych pieniędzy, dar&oacute;w, nagrody lub odszkodowania za swoje osobiste zyski z lub w inny spos&oacute;b złożyć się w ramach zobowiązania pieniężnego do jakiejkolwiek osoby/klienta, z kt&oacute;rym może być posiadanie oficjalne relacje.</p>
            <p>10. Zakończenie</p>

            <p>10.1 Powołanie może zostać wypowiedziane przez Sp&oacute;łkę, bez względu na przyczynę, poprzez podanie nie mniej niż [ Zawiadomienie] miesięcy uprzedniego wypowiedzenia na piśmie lub wynagrodzenia w miejsce jego wystąpienia. Dla cel&oacute;w niniejszej klauzuli, wynagrodzenie oznacza wynagrodzenie podstawowe.</p>

            <p>10.2 Użytkownik może rozwiązać umowę o pracę ze Sp&oacute;łką, bez jakiejkolwiek przyczyny, podając nie mniej niż [ ogłoszenie o pracowniku] miesiące przed powiadomieniem lub wynagrodzeniem za niezaoszczędzony okres, pozostawiony po skorygowaniu oczekujących liści, jak na dzień.</p>

            <p>10.3 Sp&oacute;łka zastrzega sobie prawo do wypowiedzenia umowy o pracę bez okresu wypowiedzenia lub wypłaty z tytułu rozwiązania umowy, jeżeli ma on uzasadnione podstawy, aby sądzić, że jesteś winny wykroczenia lub niedbalstwa, lub popełnił jakiekolwiek istotne naruszenie umowy lub spowodował jakiekolwiek straty w Sp&oacute;łce.&nbsp;</p>

            <p>10. 4 W sprawie rozwiązania stosunku pracy z jakiegokolwiek powodu, powr&oacute;cisz do Sp&oacute;łki wszystkie nieruchomości; dokumenty, i&nbsp;</p>

            <p>papieru, zar&oacute;wno oryginału, jak i jego kopii, w tym wszelkich pr&oacute;bek, literatury, um&oacute;w, zapis&oacute;w, wykaz&oacute;w, rysunk&oacute;w, konspekt&oacute;w,</p>

            <p>listy, notatki, dane i podobne; informacje poufne, znajdujące się w posiadaniu lub pod Twoją kontrolą związane z zatrudnieniem lub sprawami biznesowymi klient&oacute;w.&nbsp; &nbsp;</p>



            <p>11. Informacje poufne</p>

            <p>11. 1 Podczas swojego zatrudnienia z Firmą poświęcisz cały czas, uwagę i umiejętności na najlepszą z Twoich możliwości</p>

            <p>swojej działalności gospodarczej. Użytkownik nie może, bezpośrednio lub pośrednio, prowadzić lub wiązać się z, być związany z, dotyka, zatrudniony lub czas lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody Company.zaangażował się w innej działalności gospodarczej lub działalności lub jakikolwiek inny post lub pracy w niepełnym wymiarze czasu lub prowadzić jakikolwiek kierunek studi&oacute;w, bez uprzedniej zgody</p>

            <p>Firma.</p>

            <p>11.2 Zawsze musisz zachować najwyższy stopień poufności i zachować jako poufny akt, dokumenty, i inne&nbsp;</p>

            <p>Informacje poufne dotyczące działalności Sp&oacute;łki, kt&oacute;re mogą być znane Państwu lub w dowolny spos&oacute;b zwierzyny, a Użytkownik będzie posługiwać się takimi zapisami, dokumentami i informacjami tylko w spos&oacute;b należycie autoryzowany w interesie Sp&oacute;łki. Do cel&oacute;w niniejszej klauzuli "Informacje poufne" oznaczają informacje o działalności Sp&oacute;łki oraz o jej klientach, kt&oacute;re nie są dostępne dla og&oacute;łu społeczeństwa i kt&oacute;re mogą być przez Państwa w trakcie zatrudnienia dowiedzione przez Państwa. Obejmuje to,</p>

            <p>ale nie ogranicza się do informacji związanych z organizacją, jej listami klient&oacute;w, politykami zatrudnienia, personelem oraz informacjami o produktach firmy, procesach, w tym pomysłach, koncepcjach, projekcjach, technikach, podręcznikach, rysunkach, projektach,&nbsp;</p>

            <p>specyfikacje, a także wszystkie dokumenty, życiorysy, zapisy i inne dokumenty zawierające takie informacje poufne.</p>

            <p>11.3 W żadnym momencie nie usunie Pan żadnych Informacji Poufnych z urzędu bez zezwolenia.</p>

            <p>11.4 Tw&oacute;j obowiązek ochrony a nie disclos</p>

            <p>Informacje poufne przetrwają wygaśnięcie lub rozwiązanie niniejszej Umowy i/lub Twoje zatrudnienie w Sp&oacute;łce.</p>

            <p>11.5 Naruszenie warunk&oacute;w niniejszej klauzuli spowoduje, że Użytkownik będzie zobowiązany do skr&oacute;conej umowy w ramach klauzuli powyżej, opr&oacute;cz wszelkich innych środk&oacute;w zaradcze, jakie Sp&oacute;łka może mieć przeciwko Państwu w prawie.</p>



            <p>12. Uwagi</p>

            <p>Ogłoszenia mogą być podane przez Państwa do Sp&oacute;łki pod adresem jej siedziby. Ogłoszenia mogą być podane przez Sp&oacute;łkę do Państwa na adres intymniony przez Państwa w ewidencji urzędowej.</p>



            <p>13. Stosowność polityki firmy</p>

            <p>Sp&oacute;łka jest uprawniona do składania deklaracji politycznych od czasu do czasu dotyczących spraw takich jak prawo do urlopu macierzyńskiego, macierzyństwo</p>

            <p>urlop&oacute;w, świadczeń pracowniczych, godzin pracy, polityki transferowej itp., a także mogą zmieniać to samo od czasu do czasu według własnego uznania.</p>

            <p>Wszystkie takie decyzje polityczne Sp&oacute;łki są wiążące dla Państwa i przesłaniają niniejszą Umowę w tym zakresie.</p>



            <p>14. Prawo właściwe/jurysdykcja</p>

            <p>Twoje zatrudnienie ze Sp&oacute;łką podlega prawu krajowi. Wszelkie spory podlegają właściwości Sądu Najwyższego</p>

            <p>Tylko Gujarat.</p>



            <p>15. Akceptacja naszej oferty</p>

            <p>Prosimy o potwierdzenie przyjęcia niniejszej Umowy o pracę poprzez podpisanie i zwr&oacute;cenie duplikatu.</p>



            <p>Zapraszamy Państwa i czekamy na Państwa przyjęcie i wsp&oacute;łpracę z Tobą.</p>



            <p>Z Państwa Sincerely,</p>

            <p>{app_name }</p>

            <p>{date }</p>',

            'pt' => '<h3 style="text-align: center;">Carta De Ades&atilde;o</h3>

            <p>{data}</p>

            <p>{employee_name}</p>

            <p>{address}</p>


            <p>Assunto: Nomea&ccedil;&atilde;o para o cargo de {designation}</p>

            <p>Querido {employee_name},</p>


            <p>Temos o prazer de oferec&ecirc;-lo, a posi&ccedil;&atilde;o de {designation} com {app_name} a Empresa nos seguintes termos e</p>
            <p>condi&ccedil;&otilde;es:</p>


            <p>1. Comentamento do emprego</p>

            <p>Seu emprego ser&aacute; efetivo, a partir de {start_date}</p>


            <p>2. T&iacute;tulo do emprego</p>

            <p>Seu cargo de trabalho ser&aacute; {designation}.</p>

            <p>3. Sal&aacute;rio</p>

            <p>Seu sal&aacute;rio e outros benef&iacute;cios ser&atilde;o conforme estabelecido no Planejamento 1, hereto.</p>

            <p>4. Local de postagem</p>

            <p>Voc&ecirc; ser&aacute; postado em {branch}. Voc&ecirc; pode, no entanto, ser obrigado a trabalhar em qualquer local de neg&oacute;cios que a Empresa tenha, ou possa posteriormente adquirir.</p>

            <p>5. Horas de Trabalho</p>

            <p>Os dias normais de trabalho s&atilde;o de segunda a sexta-feira. Voc&ecirc; ser&aacute; obrigado a trabalhar por tais horas, conforme necess&aacute;rio para a quita&ccedil;&atilde;o adequada de suas fun&ccedil;&otilde;es para a Companhia. As horas de trabalho normais s&atilde;o de {start_time} para {end_time} e voc&ecirc; deve trabalhar n&atilde;o menos de {total_horas} horas semanais, e se necess&aacute;rio para horas adicionais dependendo do seu</p>
            <p>responsabilidades.</p>

            <p>6. Leave / Holidays</p>

            <p>6,1 Voc&ecirc; tem direito a licen&ccedil;a casual de 12 dias.</p>

            <p>6,2 Voc&ecirc; tem direito a 12 dias &uacute;teis de licen&ccedil;a remunerada remunerada.</p>

            <p>6,3 Companhia notificar&aacute; uma lista de feriados declarados no in&iacute;cio de cada ano.&nbsp;</p>



            <p>7. Natureza dos deveres</p>

            <p>Voc&ecirc; ir&aacute; executar ao melhor da sua habilidade todos os deveres como s&atilde;o inerentes ao seu cargo e tais deveres adicionais como a empresa pode ligar sobre voc&ecirc; para executar, de tempos em tempos. Os seus deveres espec&iacute;ficos s&atilde;o estabelecidos no Hereto do Planejamento II.</p>



            <p>8. Propriedade da empresa</p>

            <p>Voc&ecirc; sempre manter&aacute; em bom estado propriedade Empresa, que poder&aacute; ser confiada a voc&ecirc; para uso oficial durante o curso de</p>

            <p>o seu emprego, e devolver&aacute; toda essa propriedade &agrave; Companhia antes de abdicar de sua acusa&ccedil;&atilde;o, falhando qual o custo do mesmo ser&aacute; recuperado de voc&ecirc; pela Companhia.</p>



            <p>9. Borremir / aceitar presentes</p>

            <p>Voc&ecirc; n&atilde;o vai pedir empr&eacute;stimo ou aceitar qualquer dinheiro, presente, recompensa ou indeniza&ccedil;&atilde;o por seus ganhos pessoais de ou de outra forma colocar-se sob obriga&ccedil;&atilde;o pecuni&aacute;ria a qualquer pessoa / cliente com quem voc&ecirc; pode estar tendo rela&ccedil;&otilde;es oficiais.</p>



            <p>10. Termina&ccedil;&atilde;o</p>

            <p>10,1 Sua nomea&ccedil;&atilde;o pode ser rescindida pela Companhia, sem qualquer raz&atilde;o, dando-lhe n&atilde;o menos do que [aviso] meses de aviso pr&eacute;vio por escrito ou de sal&aacute;rio em lieu deste. Para efeito da presente cl&aacute;usula, o sal&aacute;rio deve significar sal&aacute;rio base.</p>

            <p>10,2 Voc&ecirc; pode rescindir seu emprego com a Companhia, sem qualquer causa, ao dar nada menos que [Aviso de contrata&ccedil;&atilde;o] meses de aviso pr&eacute;vio ou sal&aacute;rio para o per&iacute;odo n&atilde;o salvo, deixado ap&oacute;s ajuste de folhas pendentes, conforme data de encontro.</p>

            <p>10,3 Empresa reserva-se o direito de rescindir o seu emprego sumariamente sem qualquer prazo de aviso ou de rescis&atilde;o se tiver terreno razo&aacute;vel para acreditar que voc&ecirc; &eacute; culpado de m&aacute; conduta ou neglig&ecirc;ncia, ou tenha cometido qualquer viola&ccedil;&atilde;o fundamental de contrato, ou tenha causado qualquer perda para a Empresa.&nbsp;</p>

            <p>10. 4 Sobre a rescis&atilde;o do seu emprego por qualquer motivo, voc&ecirc; retornar&aacute; para a Empresa todos os bens; documentos e&nbsp;</p>

            <p>papel, tanto originais como c&oacute;pias dos mesmos, incluindo quaisquer amostras, literatura, contratos, registros, listas, desenhos, plantas,</p>

            <p>cartas, notas, dados e semelhantes; e Informa&ccedil;&otilde;es Confidenciais, em sua posse ou sob seu controle relacionado ao seu emprego ou aos neg&oacute;cios de neg&oacute;cios dos clientes.&nbsp; &nbsp;</p>



            <p>11. Informa&ccedil;&otilde;es Confidenciais</p>

            <p>11. 1 Durante o seu emprego com a Companhia voc&ecirc; ir&aacute; dedicar todo o seu tempo, aten&ccedil;&atilde;o e habilidade para o melhor de sua capacidade de</p>

            <p>o seu neg&oacute;cio. Voc&ecirc; n&atilde;o deve, direta ou indiretamente, se envolver ou associar-se com, estar conectado com, preocupado, empregado, ou tempo ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do Company.engajado em qualquer outro neg&oacute;cio ou atividades ou qualquer outro cargo ou trabalho parcial ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do</p>

            <p>Empresa.</p>

            <p>11,2 &Eacute; preciso manter sempre o mais alto grau de confidencialidade e manter como confidenciais os registros, documentos e outros&nbsp;</p>

            <p>Informa&ccedil;&otilde;es confidenciais relativas ao neg&oacute;cio da Companhia que possam ser conhecidas por voc&ecirc; ou confiadas em voc&ecirc; por qualquer meio e utilizar&atilde;o tais registros, documentos e informa&ccedil;&otilde;es apenas de forma devidamente autorizada no interesse da Companhia. Para efeitos da presente cl&aacute;usula "Informa&ccedil;&otilde;es confidenciais" significa informa&ccedil;&atilde;o sobre os neg&oacute;cios da Companhia e a dos seus clientes que n&atilde;o est&aacute; dispon&iacute;vel para o p&uacute;blico em geral e que poder&aacute; ser aprendida por voc&ecirc; no curso do seu emprego. Isso inclui,</p>

            <p>mas n&atilde;o se limita a, informa&ccedil;&otilde;es relativas &agrave; organiza&ccedil;&atilde;o, suas listas de clientes, pol&iacute;ticas de emprego, pessoal, e informa&ccedil;&otilde;es sobre os produtos da Companhia, processos incluindo ideias, conceitos, proje&ccedil;&otilde;es, tecnologia, manuais, desenho, desenhos,&nbsp;</p>

            <p>especifica&ccedil;&otilde;es, e todos os pap&eacute;is, curr&iacute;culos, registros e outros documentos que contenham tais Informa&ccedil;&otilde;es Confidenciais.</p>

            <p>11,3 Em nenhum momento, voc&ecirc; remover&aacute; quaisquer Informa&ccedil;&otilde;es Confidenciais do escrit&oacute;rio sem permiss&atilde;o.</p>

            <p>11,4 O seu dever de salvaguardar e n&atilde;o os desclos</p>

            <p>Informa&ccedil;&otilde;es Confidenciais sobreviver&atilde;o &agrave; expira&ccedil;&atilde;o ou &agrave; rescis&atilde;o deste Contrato e / ou do seu emprego com a Companhia.</p>

            <p>11,5 Viola&ccedil;&atilde;o das condi&ccedil;&otilde;es desta cl&aacute;usula ir&aacute; torn&aacute;-lo sujeito a demiss&atilde;o sum&aacute;ria sob a cl&aacute;usula acima, al&eacute;m de qualquer outro rem&eacute;dio que a Companhia possa ter contra voc&ecirc; em lei.</p>



            <p>12. Notices</p>

            <p>Os avisos podem ser conferidos por voc&ecirc; &agrave; Empresa em seu endere&ccedil;o de escrit&oacute;rio registrado. Os avisos podem ser conferidos pela Companhia a voc&ecirc; no endere&ccedil;o intimado por voc&ecirc; nos registros oficiais.</p>



            <p>13. Aplicabilidade da Pol&iacute;tica da Empresa</p>

            <p>A Companhia tem direito a fazer declara&ccedil;&otilde;es de pol&iacute;tica de tempos em tempos relativos a mat&eacute;rias como licen&ccedil;a de licen&ccedil;a, maternidade</p>

            <p>sair, benef&iacute;cios dos empregados, horas de trabalho, pol&iacute;ticas de transfer&ecirc;ncia, etc., e pode alterar o mesmo de vez em quando a seu exclusivo crit&eacute;rio.</p>

            <p>Todas essas decis&otilde;es de pol&iacute;tica da Companhia devem ser vinculativas para si e substituir&atilde;o este Acordo nessa medida.</p>



            <p>14. Direito / Jurisdi&ccedil;&atilde;o</p>

            <p>Seu emprego com a Companhia est&aacute; sujeito &agrave;s leis do Pa&iacute;s. Todas as disputas est&atilde;o sujeitas &agrave; jurisdi&ccedil;&atilde;o do Tribunal Superior</p>

            <p>Gujarat apenas.</p>



            <p>15. Aceita&ccedil;&atilde;o da nossa oferta</p>

            <p>Por favor, confirme sua aceita&ccedil;&atilde;o deste Contrato de Emprego assinando e retornando a c&oacute;pia duplicada.</p>



            <p>N&oacute;s acolhemos voc&ecirc; e estamos ansiosos para receber sua aceita&ccedil;&atilde;o e para trabalhar com voc&ecirc;.</p>



            <p>Seu Sinceramente,</p>

            <p>{app_name}</p>

            <p>{data}</p>',


            'ru' => '<h3 style="text-align: center;">Присоединение к письму</h3>

            <p>{date}</p>

            <p>{ employee_name }</p>
            <p>{address}</p>

            <p>Тема: Назначение на должность {designation}</p>

            <p>Уважаемый { employee_name },</p>

            <p>Мы рады предложить Вам, позицию {designation} с { app_name } Компания на следующих условиях и</p>

            <p>условия:</p>


            <p>1. Начало работы</p>

            <p>Ваше трудоустройство будет эффективным, начиная с { start_date }</p>


            <p>2. Название должности</p>
            <p>Ваш заголовок задания будет {designation}.</p>

            <p>3. Зарплата</p>
            <p>Ваши оклады и другие пособия будут установлены в соответствии с расписанием, изложенным в приложении 1 к настоящему.</p>

            <p>4. Место размещения</p>
            <p>Вы будете работать в { branch }. Вы, однако, можете работать в любом месте, которое компания имеет или может впоследствии приобрести.</p>



            <p>5. Часы работы</p>
            <p>Обычные рабочие дни-с понедельника по пятницу. Вы должны будете работать в течение таких часов, как это необходимо для надлежащего выполнения Ваших обязанностей перед компанией. Обычные рабочие часы-от { start_time } до { end_time }, и вы, как ожидается, будут работать не менее { total_hours } часов каждую неделю, и при необходимости в течение дополнительных часов в зависимости от вашего</p>
            <p>ответственности.</p>
            <p>6. Отпуск/Праздники</p>

            <p>6.1 Вы имеете право на случайный отпуск продолжительностью 12 дней.</p>

            <p>6.2 Вы имеете право на 12 рабочих дней оплачиваемого отпуска по болезни.</p>

            <p>6.3 Компания в начале каждого года уведомляет об объявленных праздниках.&nbsp;</p>



            <p>7. Характер обязанностей</p>

            <p>Вы будете выполнять все обязанности, присующие вам, и такие дополнительные обязанности, которые компания может призвать к вам, время от времени. Ваши конкретные обязанности изложены в приложении II к настоящему.</p>



            <p>8. Свойство компании</p>

            <p>Вы всегда будете поддерживать в хорошем состоянии имущество Компании, которое может быть доверено Вам для служебного пользования в течение</p>

            <p>вашей занятости, и возвратит все это имущество Компании до отказа от вашего заряда, при отсутствии которого стоимость одного и того же имущества будет взыскана с Вас компанией.</p>



            <p>9. Боровить/принять подарки</p>

            <p>Вы не будете брать взаймы или принимать какие-либо деньги, подарки, вознаграждение или компенсацию за ваши личные доходы от или в ином месте под денежный долг любому лицу/клиенту, с которым у вас могут быть официальные сделки.</p>



            <p>10. Прекращение</p>

            <p>10.1 Ваше назначение может быть прекращено компанией без каких бы то ни было оснований, предоставляя Вам не менее [ Уведомление] месяцев, предшея уведомлению в письменной форме или окладе вместо них. Для целей этого положения заработная плата означает базовый оклад.</p>

            <p>10.2 Вы можете прекратить свою трудовую деятельность с компанией без каких-либо причин, предоставляя не меньше, чем [ Employee Notice] months  предварительное уведомление или оклад за несохраненный период, оставатся после корректировки отложенных листьев, как на сегодняшний день.</p>

            <p>10.3 Компания оставляет за собой право прекратить вашу работу в суммарном порядке без какого-либо уведомления о сроке или увольнении, если у нее есть достаточные основания полагать, что вы виновны в проступке или халатности, или совершили какое-либо существенное нарушение договора, или причинило убытки Компании.&nbsp;</p>

            <p>10. 4 О прекращении вашей работы по какой бы то ни было причине вы вернетесь в Компании все имущество; документы, а&nbsp;</p>

            <p>бумаги, как оригинальные, так и их копии, включая любые образцы, литературу, контракты, записи, списки, чертежи, чертежи,</p>

            <p>письма, заметки, данные и тому подобное; и Конфиденциальная информация, в вашем распоряжении или под вашим контролем, связанным с вашей работой или деловыми делами клиентов.&nbsp; &nbsp;</p>



            <p>11. Конфиденциальная информация</p>

            <p>11. 1 Во время вашего трудоустройства с компанией Вы посвяте все свое время, внимание, умение максимально</p>

            <p>Его бизнес. Вы не должны, прямо или косвенно, заниматься или ассоциировать себя с заинтересованными, занятым, занятым, или временем, или продолжать любой курс обучения, без предварительного разрешения Компани.заниматься каким-либо другим бизнесом или деятельностью или любой другой пост или работать неполный рабочий день или заниматься какой бы то ни было исследованием, без предварительного разрешения</p>

            <p>Компания.</p>

            <p>11.2 Вы всегда должны сохранять наивысшую степень конфиденциальности и хранить в качестве конфиденциальной записи, документы и другие&nbsp;</p>

            <p>Конфиденциальная информация, касающаяся бизнеса Компании, которая может быть вам известна или конфиденциальна любым способом, и Вы будете использовать такие записи, документы и информацию только в установленном порядке в интересах Компании. Для целей настоящей статьи "Конфиденциальная информация" означает информацию о бизнесе Компании и о ее клиентах, которая недоступна для широкой общественности и которая может быть изучилась Вами в ходе вашей работы. Это включает в себя:</p>

            <p>но не ограничивается информацией, касающейся организации, ее списков клиентов, политики в области занятости, персонала и информации о продуктах Компании, процессах, включая идеи, концепции, прогнозы, технологии, руководства, чертеж, чертеж,&nbsp;</p>

            <p>спецификации, и все бумаги, резюме, записи и другие документы, содержащие такую Конфиденциальную Информацию.</p>

            <p>11.3 В любое время вы не будете удалять конфиденциальную информацию из офиса без разрешения.</p>

            <p>11.4 Ваш долг защищать и не отсосать</p>

            <p>e Конфиденциальная информация выдержит срок действия или прекращения действия настоящего Соглашения и/или вашей работы с компанией.</p>

            <p>11.5 Нарушение условий, изложенных в настоящем положении, приведет к тому, что в дополнение к любым другим средствам правовой защиты, которые компания может иметь против вас, в соответствии с вышеприведенным положением, вы можете получить краткое увольнение в соответствии с этим положением.</p>



            <p>12. Замечания</p>

            <p>Уведомления могут быть даны Вами Компании по адресу ее зарегистрированного офиса. Извещения могут быть даны компанией Вам по адресу, с которым вы в официальных отчетах.</p>



            <p>13. Применимость политики компании</p>

            <p>Компания вправе время от времени делать политические заявления по таким вопросам, как право на отпуск, материнство</p>

            <p>отпуска, пособия для работников, продолжительность рабочего дня, трансферная политика и т.д. и время от времени могут изменяться исключительно по своему усмотрению.</p>

            <p>Все такие принципиальные решения Компании являются обязательными для Вас и переопределяют это Соглашение в такой степени.</p>



            <p>14. Регулирующий Право/юрисдикция</p>

            <p>Ваше трудоустройство с компанией подпадает под действие законов страны. Все споры подлежат юрисдикции Высокого суда</p>

            <p>Только Гуджарат.</p>



            <p>15. Принятие нашего предложения</p>

            <p>Пожалуйста, подтвердите свое согласие с этим Договором о занятости, подписав и возвращая дубликат копии.</p>



            <p>Мы приветствуем Вас и надеемся на то, что Вы принимаете свое согласие и работаете с Вами.</p>



            <p>Искренне Ваш,</p>

            <p>{ app_name }</p>

            <p>{date}</p>',

            'tr'=>'<h3 style="text-align: center;">Katılım Mektubu</h3>
            <p>{tarih}</p>
            <p>{çalışan_adı}</p>
            <p>{adres</p>
            <p>Konu: {tanımlama</p> görevi için randevu
            <p>Sayın {çalışan_adı},</p>
            <p>Aşağıdaki şartlar ve</p> ile Şirkette {app_name} ile {designation} konumunu size sunmaktan mutluluk duyuyoruz.</p>
            <p>koşullar:</p>
            <p>1. İşe başlama</p>
            <p>İstihdamınız {start_date}</p> itibarıyla geçerli olacak
            <p>2. İş unvanı</p>
            <p>İş unvanınız {tanımlama} olacaktır.</p>
            <p>3. maaş</p>
            <p>Maaşınız ve diğer yardımlarınız, bundan böyle Çizelge 1 de belirtildiği gibi olacaktır.</p>
            <p>4. Gönderim yeri</p>
            <p>{branch} adresinde ilan edileceksiniz. Ancak, Şirketin sahip olduğu herhangi bir işyerinde çalışmanız gerekebilir veya</p>
            <p>daha sonra edinilebilir.</p>
            <p>5. Çalışma Saatleri</p>
            <p>Normal çalışma günleri Pazartesi den Cuma ya kadardır. </p> için gerekli olan saatlerde çalışmanız istenecektir.
            <p>Şirkete karşı görevlerinizi uygun şekilde yerine getirme. Normal çalışma saatleri {start_time} ile {end_time} arasındadır ve siz</p>
            <p>Her hafta en az {total_hours} saat ve gerekirse sizin durumunuza bağlı olarak ek saat çalışması bekleniyor</p>
            <p>sorumluluklar.</p>
            <p>6. İzin/Tatiller</p>
            <p>6.1 12 günlük geçici izin hakkınız var.</p>
            <p>6.2 12 iş günü ücretli hastalık izni hakkınız var.</p>
            <p>6.3 Şirket, her yılın başında ilan edilen tatillerin listesini bildirecektir.</p>
            <p>7. Görevlerin niteliği</p>
            <p>Görevinizle ilgili tüm görevleri ve şirket olarak bu tür ek görevleri elinizden gelen en iyi şekilde yerine getireceksiniz</p>
            <p>zaman zaman performans sergilemeniz için sizi çağırabilir. Özel görevleriniz, buradaki Çizelge II de belirtilmiştir.</p>
            <p>8. Şirket mülkü</p>
            <p>Süreç boyunca resmi kullanım için size emanet edilmiş olabilecek Şirket mülkünü her zaman iyi durumda tutacaksınız</p>
            <p>istihdamınız ve ücretinizden feragat etmeden önce bu tür tüm mülkleri Şirkete iade edecektir, aksi takdirde maliyet</p>
            <p>Aynısı Şirket tarafından sizden geri alınacaktır.</p>
            <p>9. Ödünç alma/hediye kabul etme</p>
            <p>Kişisel kazançlarınız için kendinizden herhangi bir para, hediye, ödül veya tazminat ödünç almayacak veya kabul etmeyeceksiniz</p>
            <p>resmi ilişki içinde olabileceğiniz herhangi bir kişiye/müşteriye karşı maddi yükümlülük altında.</p>
            <p>10. Fesih</p>
            <p>10.1 Randevunuz, Şirket tarafından size en az [Bildirim] ay öncesinden bildirimde bulunarak herhangi bir sebep olmaksızın feshedilebilir</p>
            <p>yazılı bildirim veya bunun yerine maaş. Bu maddenin amaçları doğrultusunda maaş, temel maaş anlamına gelir.</p>
            <p>10.2 En az [Çalışan Bildirimi]</p> vererek Şirketteki çalışmanızı herhangi bir neden olmaksızın sonlandırabilirsiniz.
            <p>Tarih itibariyle, bekleyen izinlerin ayarlanmasından sonra kalan, kaydedilmemiş dönem için aylar öncesinden bildirim veya maaş.</p>
            <p>10.3 Şirket, herhangi bir ihbar süresi veya fesih ödemesi olmaksızın iş akdinizi aniden feshetme hakkını saklı tutar</p>
            <p>Suistimal veya ihmalden suçlu olduğunuza veya herhangi bir temel ihlalde bulunduğunuza inanmak için makul bir gerekçesi varsa</p>
            <p>sözleşmeye veya Şirkete herhangi bir zarara neden oldu.</p>
            <p>10. 4 Herhangi bir nedenle işinize son verildiğinde, tüm mal varlığınızı Şirkete iade edeceksiniz; belgeler ve</p>
            <p>Örnekler, literatür, sözleşmeler, kayıtlar, listeler, çizimler, ozalitler dahil kağıt, hem orijinali hem de kopyaları</p>
            <p>mektuplar, notlar, veriler ve benzerleri; ve Sizinle ilgili olarak sahip olduğunuz veya kontrolünüz altındaki Gizli Bilgiler</p>
            <p>istihdam veya müşterilerin iş ilişkileri.</p>
            <p>11. Gizli Bilgiler</p>
            <p>11. 1 Şirkette çalıştığınız süre boyunca tüm zamanınızı, dikkatinizi ve becerinizi elinizden gelenin en iyisini yapmaya adayacaksınız</p>
            <p>onun işi. Doğrudan veya dolaylı olarak kendinizle ilişki kurmamalı veya ilişkilendirmemeli, bunlarla bağlantı kurmamalı, ilgilenmemeli, istihdam edilmemeli veya</p>
            <p>Şirketin önceden izni olmaksızın herhangi bir eğitim kursuna katılmak veya devam etmek.Başka herhangi bir işle uğraşmak veya</p>
            <p>aktiviteler veya diğer herhangi bir görevlendirme veya yarı zamanlı çalışma veya herhangi bir eğitim kursuna devam etme,</p>
            <p>Şirket.</p>
            <p>11.2 Gizliliği her zaman en üst düzeyde tutmalı ve kayıtları, belgeleri ve diğer bilgileri gizli tutmalısınız</p>
            <p>Şirketin faaliyetleriyle ilgili olarak sizin tarafınızdan bilinebilecek veya herhangi bir şekilde size güvenilebilecek Gizli Bilgiler</p>
            <p>ve bu tür kayıtları, belgeleri ve bilgileri yalnızca Şirketin çıkarları doğrultusunda usulüne uygun olarak yetkilendirilmiş bir şekilde kullanacaksınız. için</p>
            <p>Bu maddenin amacı Gizli Bilgiler, Şirketin ve müşterilerinin işleri hakkında bilgiler anlamına gelir</p>
            <p>genel halka açık olmayan ve istihdamınız sırasında sizin tarafınızdan öğrenilebilecek bilgiler. Bu,</p>
            <p>kuruluşa, müşteri listelerine, istihdam politikalarına, personeline ve bilgilerine ilişkin bilgiler ve bunlarla sınırlı olmamak üzere</p>
            <p>Fikirler, kavramlar, projeksiyonlar, teknoloji, kılavuzlar, çizimler, tasarımlar dahil olmak üzere Şirketin ürünleri ve süreçleri hakkında</p>
            <p>şartnameler ve bu tür Gizli Bilgileri içeren tüm belgeler, özgeçmişler, kayıtlar ve diğer belgeler.</p>
            <p>11.3 Hiçbir Gizli Bilgiyi izinsiz olarak ofisten çıkarmayacaksınız.</p>
            <p>11.4 Koruma ve açıklamama göreviniz</p>
            <p>Gizli Bilgiler, bu Sözleşmenin sona ermesinden veya feshedilmesinden ve/veya Şirketteki istihdamınızın sona ermesinden sonra da geçerliliğini koruyacaktır.</p>
            <p>11.5 Bu maddenin koşullarının ihlal edilmesi, sizi herhangi bir ek olarak yukarıdaki madde kapsamında derhal işten çıkarmayla yükümlü kılacaktır</p>
            <p>Şirketin kanunen size karşı sahip olabileceği diğer çareler.</p>
            <p>12. Bildirimler</p>
            <p>Tebligatlar, tarafınızca Şirketin kayıtlı ofis adresine gönderilebilir. Bildirimler Şirket tarafından size şu adreste verilebilir:</p>
            <p>resmi kayıtlarda belirttiğiniz adres.</p>
            <p>13. Şirket Politikasının Uygulanabilirliği</p>
            <p>Şirket, izin hakkı, analık gibi konularda zaman zaman poliçe beyanı yapma hakkına sahip olacaktır</p>
            <p>izin, çalışanlara sağlanan faydalar, çalışma saatleri, transfer politikaları vb. ve tamamen kendi takdirine bağlı olarak zaman zaman aynı şeyi değiştirebilir.</p>
            <p>Şirketin bu tür tüm politika kararları sizin için bağlayıcı olacak ve bu Sözleşmeyi o ölçüde geçersiz kılacaktır.</p>
            <p>14. Geçerli Yasa/Yetki Alanı</p>
            <p>Şirketteki istihdamınız Ülke yasalarına tabidir. Tüm ihtilaflar Yüksek Mahkemenin yargı yetkisine tabi olacaktır</p>
            <p>Yalnızca Gujarat.</p>
            <p>15. Teklifimizin kabulü</p>
            <p>Lütfen bu İş Sözleşmesini kabul ettiğinizi imzalayarak ve kopya kopyayı geri vererek onaylayın.</p>
            <p>Hoş geldiniz ve kabulünüzü almayı ve sizinle çalışmayı sabırsızlıkla bekliyoruz.</p>
            <p>Saygılarımızla,</p>
            <p>{uygulama_adı}</p>
            <p>{tarih}</p>',

            'pt-br' => '<h3 style="text-align: center;">Carta De Ades&atilde;o</h3>

            <p>{data}</p>

            <p>{employee_name}</p>

            <p>{address}</p>


            <p>Assunto: Nomea&ccedil;&atilde;o para o cargo de {designation}</p>

            <p>Querido {employee_name},</p>


            <p>Temos o prazer de oferec&ecirc;-lo, a posi&ccedil;&atilde;o de {designation} com {app_name} a Empresa nos seguintes termos e</p>
            <p>condi&ccedil;&otilde;es:</p>


            <p>1. Comentamento do emprego</p>

            <p>Seu emprego ser&aacute; efetivo, a partir de {start_date}</p>


            <p>2. T&iacute;tulo do emprego</p>

            <p>Seu cargo de trabalho ser&aacute; {designation}.</p>

            <p>3. Sal&aacute;rio</p>

            <p>Seu sal&aacute;rio e outros benef&iacute;cios ser&atilde;o conforme estabelecido no Planejamento 1, hereto.</p>

            <p>4. Local de postagem</p>

            <p>Voc&ecirc; ser&aacute; postado em {branch}. Voc&ecirc; pode, no entanto, ser obrigado a trabalhar em qualquer local de neg&oacute;cios que a Empresa tenha, ou possa posteriormente adquirir.</p>

            <p>5. Horas de Trabalho</p>

            <p>Os dias normais de trabalho s&atilde;o de segunda a sexta-feira. Voc&ecirc; ser&aacute; obrigado a trabalhar por tais horas, conforme necess&aacute;rio para a quita&ccedil;&atilde;o adequada de suas fun&ccedil;&otilde;es para a Companhia. As horas de trabalho normais s&atilde;o de {start_time} para {end_time} e voc&ecirc; deve trabalhar n&atilde;o menos de {total_horas} horas semanais, e se necess&aacute;rio para horas adicionais dependendo do seu</p>
            <p>responsabilidades.</p>

            <p>6. Leave / Holidays</p>

            <p>6,1 Voc&ecirc; tem direito a licen&ccedil;a casual de 12 dias.</p>

            <p>6,2 Voc&ecirc; tem direito a 12 dias &uacute;teis de licen&ccedil;a remunerada remunerada.</p>

            <p>6,3 Companhia notificar&aacute; uma lista de feriados declarados no in&iacute;cio de cada ano.&nbsp;</p>



            <p>7. Natureza dos deveres</p>

            <p>Voc&ecirc; ir&aacute; executar ao melhor da sua habilidade todos os deveres como s&atilde;o inerentes ao seu cargo e tais deveres adicionais como a empresa pode ligar sobre voc&ecirc; para executar, de tempos em tempos. Os seus deveres espec&iacute;ficos s&atilde;o estabelecidos no Hereto do Planejamento II.</p>



            <p>8. Propriedade da empresa</p>

            <p>Voc&ecirc; sempre manter&aacute; em bom estado propriedade Empresa, que poder&aacute; ser confiada a voc&ecirc; para uso oficial durante o curso de</p>

            <p>o seu emprego, e devolver&aacute; toda essa propriedade &agrave; Companhia antes de abdicar de sua acusa&ccedil;&atilde;o, falhando qual o custo do mesmo ser&aacute; recuperado de voc&ecirc; pela Companhia.</p>



            <p>9. Borremir / aceitar presentes</p>

            <p>Voc&ecirc; n&atilde;o vai pedir empr&eacute;stimo ou aceitar qualquer dinheiro, presente, recompensa ou indeniza&ccedil;&atilde;o por seus ganhos pessoais de ou de outra forma colocar-se sob obriga&ccedil;&atilde;o pecuni&aacute;ria a qualquer pessoa / cliente com quem voc&ecirc; pode estar tendo rela&ccedil;&otilde;es oficiais.</p>



            <p>10. Termina&ccedil;&atilde;o</p>

            <p>10,1 Sua nomea&ccedil;&atilde;o pode ser rescindida pela Companhia, sem qualquer raz&atilde;o, dando-lhe n&atilde;o menos do que [aviso] meses de aviso pr&eacute;vio por escrito ou de sal&aacute;rio em lieu deste. Para efeito da presente cl&aacute;usula, o sal&aacute;rio deve significar sal&aacute;rio base.</p>

            <p>10,2 Voc&ecirc; pode rescindir seu emprego com a Companhia, sem qualquer causa, ao dar nada menos que [Aviso de contrata&ccedil;&atilde;o] meses de aviso pr&eacute;vio ou sal&aacute;rio para o per&iacute;odo n&atilde;o salvo, deixado ap&oacute;s ajuste de folhas pendentes, conforme data de encontro.</p>

            <p>10,3 Empresa reserva-se o direito de rescindir o seu emprego sumariamente sem qualquer prazo de aviso ou de rescis&atilde;o se tiver terreno razo&aacute;vel para acreditar que voc&ecirc; &eacute; culpado de m&aacute; conduta ou neglig&ecirc;ncia, ou tenha cometido qualquer viola&ccedil;&atilde;o fundamental de contrato, ou tenha causado qualquer perda para a Empresa.&nbsp;</p>

            <p>10. 4 Sobre a rescis&atilde;o do seu emprego por qualquer motivo, voc&ecirc; retornar&aacute; para a Empresa todos os bens; documentos e&nbsp;</p>

            <p>papel, tanto originais como c&oacute;pias dos mesmos, incluindo quaisquer amostras, literatura, contratos, registros, listas, desenhos, plantas,</p>

            <p>cartas, notas, dados e semelhantes; e Informa&ccedil;&otilde;es Confidenciais, em sua posse ou sob seu controle relacionado ao seu emprego ou aos neg&oacute;cios de neg&oacute;cios dos clientes.&nbsp; &nbsp;</p>



            <p>11. Informa&ccedil;&otilde;es Confidenciais</p>

            <p>11. 1 Durante o seu emprego com a Companhia voc&ecirc; ir&aacute; dedicar todo o seu tempo, aten&ccedil;&atilde;o e habilidade para o melhor de sua capacidade de</p>

            <p>o seu neg&oacute;cio. Voc&ecirc; n&atilde;o deve, direta ou indiretamente, se envolver ou associar-se com, estar conectado com, preocupado, empregado, ou tempo ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do Company.engajado em qualquer outro neg&oacute;cio ou atividades ou qualquer outro cargo ou trabalho parcial ou prosseguir qualquer curso de estudo, sem a permiss&atilde;o pr&eacute;via do</p>

            <p>Empresa.</p>

            <p>11,2 &Eacute; preciso manter sempre o mais alto grau de confidencialidade e manter como confidenciais os registros, documentos e outros&nbsp;</p>

            <p>Informa&ccedil;&otilde;es confidenciais relativas ao neg&oacute;cio da Companhia que possam ser conhecidas por voc&ecirc; ou confiadas em voc&ecirc; por qualquer meio e utilizar&atilde;o tais registros, documentos e informa&ccedil;&otilde;es apenas de forma devidamente autorizada no interesse da Companhia. Para efeitos da presente cl&aacute;usula "Informa&ccedil;&otilde;es confidenciais" significa informa&ccedil;&atilde;o sobre os neg&oacute;cios da Companhia e a dos seus clientes que n&atilde;o est&aacute; dispon&iacute;vel para o p&uacute;blico em geral e que poder&aacute; ser aprendida por voc&ecirc; no curso do seu emprego. Isso inclui,</p>

            <p>mas n&atilde;o se limita a, informa&ccedil;&otilde;es relativas &agrave; organiza&ccedil;&atilde;o, suas listas de clientes, pol&iacute;ticas de emprego, pessoal, e informa&ccedil;&otilde;es sobre os produtos da Companhia, processos incluindo ideias, conceitos, proje&ccedil;&otilde;es, tecnologia, manuais, desenho, desenhos,&nbsp;</p>

            <p>especifica&ccedil;&otilde;es, e todos os pap&eacute;is, curr&iacute;culos, registros e outros documentos que contenham tais Informa&ccedil;&otilde;es Confidenciais.</p>

            <p>11,3 Em nenhum momento, voc&ecirc; remover&aacute; quaisquer Informa&ccedil;&otilde;es Confidenciais do escrit&oacute;rio sem permiss&atilde;o.</p>

            <p>11,4 O seu dever de salvaguardar e n&atilde;o os desclos</p>

            <p>Informa&ccedil;&otilde;es Confidenciais sobreviver&atilde;o &agrave; expira&ccedil;&atilde;o ou &agrave; rescis&atilde;o deste Contrato e / ou do seu emprego com a Companhia.</p>

            <p>11,5 Viola&ccedil;&atilde;o das condi&ccedil;&otilde;es desta cl&aacute;usula ir&aacute; torn&aacute;-lo sujeito a demiss&atilde;o sum&aacute;ria sob a cl&aacute;usula acima, al&eacute;m de qualquer outro rem&eacute;dio que a Companhia possa ter contra voc&ecirc; em lei.</p>



            <p>12. Notices</p>

            <p>Os avisos podem ser conferidos por voc&ecirc; &agrave; Empresa em seu endere&ccedil;o de escrit&oacute;rio registrado. Os avisos podem ser conferidos pela Companhia a voc&ecirc; no endere&ccedil;o intimado por voc&ecirc; nos registros oficiais.</p>



            <p>13. Aplicabilidade da Pol&iacute;tica da Empresa</p>

            <p>A Companhia tem direito a fazer declara&ccedil;&otilde;es de pol&iacute;tica de tempos em tempos relativos a mat&eacute;rias como licen&ccedil;a de licen&ccedil;a, maternidade</p>

            <p>sair, benef&iacute;cios dos empregados, horas de trabalho, pol&iacute;ticas de transfer&ecirc;ncia, etc., e pode alterar o mesmo de vez em quando a seu exclusivo crit&eacute;rio.</p>

            <p>Todas essas decis&otilde;es de pol&iacute;tica da Companhia devem ser vinculativas para si e substituir&atilde;o este Acordo nessa medida.</p>



            <p>14. Direito / Jurisdi&ccedil;&atilde;o</p>

            <p>Seu emprego com a Companhia est&aacute; sujeito &agrave;s leis do Pa&iacute;s. Todas as disputas est&atilde;o sujeitas &agrave; jurisdi&ccedil;&atilde;o do Tribunal Superior</p>

            <p>Gujarat apenas.</p>



            <p>15. Aceita&ccedil;&atilde;o da nossa oferta</p>

            <p>Por favor, confirme sua aceita&ccedil;&atilde;o deste Contrato de Emprego assinando e retornando a c&oacute;pia duplicada.</p>



            <p>N&oacute;s acolhemos voc&ecirc; e estamos ansiosos para receber sua aceita&ccedil;&atilde;o e para trabalhar com voc&ecirc;.</p>



            <p>Seu Sinceramente,</p>

            <p>{app_name}</p>

            <p>{data}</p>
            ',

     ];

        foreach($defaultTemplate as $lang => $content)
        {
            JoiningLetter::create(
                [
                    'lang' => $lang,
                    'content' => $content,
                    'created_by' => $user_id,

                ]
            );
        }

    }


}
