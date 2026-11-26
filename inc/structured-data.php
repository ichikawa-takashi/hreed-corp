<?php
/**
 * 構造化データ(JSON-LD)
 *
 * - トップページ: Organization(会社情報)/ WebSite(サイト情報)
 * - 会社概要: Organization(会社情報)
 * - 事業内容: Service(サービス)/ FAQPage(よくあるご質問)
 * - 採用情報: JobPosting(求人情報・Googleしごと検索向け)
 * - お知らせ詳細: NewsArticle / 支援事例詳細: Article
 *
 * 会社情報・募集要項はテンプレートに直書きのため、ここも直書きにしている。
 * page-company.php / page-recruit.php の内容を変えたときは、こちらも合わせて更新すること。
 * FAQは hreed_service_faqs() をページ表示と共用しているため、ここを直せば両方に反映される。
 *
 * 確認: https://search.google.com/test/rich-results
 */

// 会社(Organization)の @id。JobPosting などから参照する
function hreed_org_id()
{
    return home_url('/#organization');
}

// 記事の著者・発行者などで参照する会社情報(最小限)
function hreed_schema_org_ref()
{
    return [
        '@type' => 'Organization',
        '@id'   => hreed_org_id(),
        'name'  => 'Hreed株式会社',
        'url'   => home_url('/'),
        'logo'  => get_template_directory_uri() . '/img/common/logo.svg',
    ];
}

// 事業内容ページの「よくあるご質問」(page-service.php の表示と共用)
// 回答の改行は <br> で入れる
function hreed_service_faqs()
{
    return [
        [
            'q' => 'RPO（採用代行）とはどこまで対応してもらえるサービスですか？',
            'a' => '採用戦略の設計から、集客、応募対応、面接代行、入社後の定着支援まで対応します。<br>企業の状況に応じて、必要な業務だけを切り出して依頼することも可能です。',
        ],
        [
            'q' => '採用担当者がいなくても依頼できますか？',
            'a' => '問題ございません。採用業務を兼任・未経験の方でも、当社が実務を代行しながら進め方をお伝えします。',
        ],
        [
            'q' => 'スポット（短期間）での利用は可能ですか？',
            'a' => '可能です。繁忙期のみの応募対応や面接調整など、必要な期間・業務のみのご依頼にも対応しています。',
        ],
        [
            'q' => '採用できなかった場合でも費用は発生しますか？',
            'a' => '料金体系はご契約プランにより異なります。詳細はお問い合わせ時に採用状況に合わせてご案内いたします。',
        ],
        [
            'q' => '土日や平日夜の面接も代行してもらえますか？',
            'a' => '対応可能です。候補者の都合に合わせて、土日・平日夜間の日程調整や面接代行も承っております。',
        ],
    ];
}

// よくあるご質問
function hreed_schema_faq_page()
{
    $items = [];
    foreach (hreed_service_faqs() as $faq) {
        $items[] = [
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    return [
        '@type'      => 'FAQPage',
        'mainEntity' => $items,
    ];
}

// 事業内容(page-service.php の内容と合わせる)
function hreed_schema_service()
{
    return [
        '@type'       => 'Service',
        'name'        => '採用支援（RPO・採用代行）',
        'serviceType' => '採用代行（RPO）・採用コンサルティング',
        'description' => '採用戦略の設計→集客→実行→定着までを一気通貫で支援します。企業ごとの課題・強みの整理、自社に合う人材像の明確化、採用プロセスの再設計から、採用オペレーション・面接代行、入社後の定着支援まで実務を含めて伴走します。',
        'url'         => home_url('/service/'),
        'provider'    => hreed_schema_org_ref(),
        'areaServed'  => [
            '@type' => 'Country',
            'name'  => '日本',
        ],
    ];
}

// お知らせ詳細(NewsArticle)・支援事例詳細(Article)
function hreed_schema_article($type)
{
    $data = [
        '@type'            => $type,
        'headline'         => wp_strip_all_tags(get_the_title()),
        'url'              => get_permalink(),
        'datePublished'    => get_the_date('c'),
        'dateModified'     => get_the_modified_date('c'),
        'author'           => hreed_schema_org_ref(),
        'publisher'        => hreed_schema_org_ref(),
        'mainEntityOfPage' => get_permalink(),
    ];
    if (has_post_thumbnail()) {
        $data['image'] = get_the_post_thumbnail_url(null, 'full');
    }
    return $data;
}

// 会社情報(page-company.php と合わせる)
function hreed_schema_organization()
{
    return [
        '@type'         => 'Organization',
        '@id'           => hreed_org_id(),
        'name'          => 'Hreed株式会社',
        'alternateName' => ['Hreed', 'フレッド'],
        'url'           => home_url('/'),
        'logo'          => get_template_directory_uri() . '/img/common/logo.svg',
        'foundingDate'  => '2022-12-12',
        'address'       => [
            '@type'           => 'PostalAddress',
            'postalCode'      => '107-0052',
            'addressRegion'   => '東京都',
            'addressLocality' => '港区',
            'streetAddress'   => '赤坂4-13-5 赤坂オフィスハイツ',
            'addressCountry'  => 'JP',
        ],
        'sameAs'        => [
            'https://note.com/hreed_1212',
        ],
    ];
}

// サイト情報
function hreed_schema_website()
{
    return [
        '@type'      => 'WebSite',
        '@id'        => home_url('/#website'),
        'name'       => 'Hreed株式会社',
        'url'        => home_url('/'),
        'inLanguage' => 'ja',
        'publisher'  => ['@id' => hreed_org_id()],
    ];
}

// 求人情報(page-recruit.php の募集要項と合わせる)
// 掲載期限(validThrough)は掲載日(datePosted)の1年後。1年ごとに両方の日付を更新すること。
// 募集を終了したときは、hreed_output_structured_data() の採用情報の出力を削除すること。
function hreed_schema_job_posting()
{
    $description = <<<HTML
<p>一人ひとりのキャリアに伴走する、“キャリアパートナー”を募集しています。</p>
<p><strong>募集職種</strong><br>キャリアアドバイザー／リクルーティングアドバイザー</p>
<p><strong>雇用形態</strong><br>正社員（中途採用）<br>試用期間：6カ月</p>
<p><strong>応募資格</strong></p>
<ul>
<li>社会人経験2年以上</li>
<li>無形商材の提案営業経験（キャリアアドバイザー経験は不問）</li>
</ul>
<p>学歴不問／職種・業種未経験OK</p>
<p><strong>給与</strong><br>月給32万円〜50万円（想定年収400万円〜600万円）<br>賞与：業績賞与（昨年度実績 1カ月分）<br>インセンティブ：あり</p>
<p><strong>勤務地</strong><br>クロスコープ渋谷ネクストサイトオフィス<br>〒150-0002 東京都渋谷区渋谷2-12-4 ネクストサイト渋谷ビル 5F<br>転勤：なし<br>※勤務地の変更範囲：会社の定める勤務地の範囲</p>
<p><strong>勤務時間</strong><br>10:00〜19:00<br>月間平均残業時間：20時間以下</p>
<p><strong>休日休暇</strong><br>土日祝休み（年間休日125日）<br>有給休暇、夏季休暇、年末年始休暇、GW休暇、産休・育休</p>
<p><strong>福利厚生</strong><br>社会保険完備、健康診断、交通費支給、役職手当<br>リモートワーク制度あり<br>フレックス制度あり</p>
HTML;

    return [
        '@type'              => 'JobPosting',
        'title'              => 'キャリアアドバイザー／リクルーティングアドバイザー',
        'description'        => $description,
        'datePosted'         => '2026-11-26',
        'validThrough'       => '2027-11-26T23:59:59+09:00',
        'employmentType'     => 'FULL_TIME',
        'hiringOrganization' => [
            '@type'  => 'Organization',
            '@id'    => hreed_org_id(),
            'name'   => 'Hreed株式会社',
            'sameAs' => home_url('/'),
            'logo'   => get_template_directory_uri() . '/img/common/logo.svg',
        ],
        'jobLocation'        => [
            '@type'   => 'Place',
            'address' => [
                '@type'           => 'PostalAddress',
                'postalCode'      => '150-0002',
                'addressRegion'   => '東京都',
                'addressLocality' => '渋谷区',
                'streetAddress'   => '渋谷2-12-4 ネクストサイト渋谷ビル 5F',
                'addressCountry'  => 'JP',
            ],
        ],
        'baseSalary'         => [
            '@type'    => 'MonetaryAmount',
            'currency' => 'JPY',
            'value'    => [
                '@type'    => 'QuantitativeValue',
                'minValue' => 320000,
                'maxValue' => 500000,
                'unitText' => 'MONTH',
            ],
        ],
        'workHours'          => '10:00〜19:00',
        'directApply'        => false,
        'url'                => home_url('/recruit/'),
    ];
}

// <head> に JSON-LD を出力する
function hreed_output_structured_data()
{
    $graph = [];

    if (is_front_page()) {
        $graph[] = hreed_schema_organization();
        $graph[] = hreed_schema_website();
    }

    if (is_page('company')) {
        $graph[] = hreed_schema_organization();
    }

    if (is_page('service')) {
        $graph[] = hreed_schema_service();
        $graph[] = hreed_schema_faq_page();
    }

    if (is_page('recruit')) {
        $graph[] = hreed_schema_job_posting();
    }

    if (is_singular('post')) {
        $graph[] = hreed_schema_article('NewsArticle');
    }

    if (is_singular('case')) {
        $graph[] = hreed_schema_article('Article');
    }

    if (!$graph) {
        return;
    }

    $data = [
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'hreed_output_structured_data');
