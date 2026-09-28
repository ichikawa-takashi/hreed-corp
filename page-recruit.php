<?php get_header(); ?>

<?php
$recruit_appeals = [
  [
    'title' => '「キャリア支援×事業成長」の両輪でスキルアップできる',
    'text'  => '転職支援だけでなく、企業の採用を支援する採用コンサルティング事業にも関わることで、求職者と企業の双方の視点を持ったキャリア支援を身につけられます。',
  ],
  [
    'title' => '代表や事業責任者と近い距離で、裁量を持って動ける',
    'text'  => '代表や事業責任者と近い距離で働くため、指示を待つだけではなく、自ら考え、裁量を持って動く経験を積める環境です。',
  ],
  [
    'title' => '面談だけでなく「キャリア支援の仕組みづくり」にも関われる',
    'text'  => '日々の面談に加え、面談手法の改善やデータ運用など、キャリア支援そのものの仕組みをより良くしていく業務にも携わっていただけます。',
  ],
  [
    'title' => '組織立ち上げ期のフェーズで、チーム文化づくりにも参画可能',
    'text'  => '組織立ち上げ期というフェーズだからこそ、チーム文化づくりや組織づくりにも初期メンバーとして参画していただけます。',
  ],
];

$recruit_tasks = [
  'キャリア面談の実施（オンライン／対面）',
  '転職希望者のキャリア設計・求人提案',
  '面接対策・内定後の意思決定サポート',
  '法人営業担当と連携したマッチング精度向上',
  '転職市場や業界トレンドの分析・情報発信',
  'キャリア支援の仕組み改善（面談手法・データ運用など）',
];

$recruit_persons = [
  [
    'title' => '必須条件',
    'items' => [
      '社会人経験2年以上',
      '無形商材の提案営業経験（キャリアアドバイザー経験は不問）',
    ],
  ],
  [
    'title' => '歓迎条件',
    'items' => [
      '体育会所属の経験（大学まで部活動に取り組んでいた方など）',
      '何かに夢中で取り組んだ経験がある方',
    ],
  ],
  [
    'title' => '求める人物像',
    'items' => [
      '人と話すことが好きな方',
      '素直な姿勢をお持ちの方',
      '成長意欲を持ち、何事も前向きに取り組める方',
      '何かしらの課題や目標を持ち、主体的に取り組める方',
    ],
  ],
  [
    'title' => 'こんな方と働きたい',
    'items' => [
      '「人のため＝自分のため」と考えられる方',
      'Hreedのミッション・ビジョン・バリューに共感できる方',
      '仕事を通して自己実現を目指している方',
    ],
  ],
];

$recruit_steps = [
  ['title' => '応募・書類選考', 'text' => 'エントリーフォームよりご応募ください。担当者より<span class="flow__text-accent">履歴書・職務経歴書のご提出</span>についてご案内し、書類選考を行います。'],
  ['title' => '一次面接（責任者）', 'text' => '事業責任者が面接を担当します。<span class="flow__text-accent">これまでのご経験や今後のキャリア</span>についてお聞かせください。'],
  ['title' => '最終面接（代表）', 'text' => '代表が面接を担当します。<span class="flow__text-accent">Hreedのビジョンや働き方</span>についても直接お伝えします。'],
  ['title' => '内定', 'text' => '選考結果をご連絡し、<span class="flow__text-accent">入社日などの条件をすり合わせ</span>ます。'],
];
?>

  <main>
    <section class="lower-mv">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text">Recruit</span></span>
          <h1 class="lower-mv__heading"><span class="lower-mv__text">採用情報</span></h1>
        </div>

        <div class="lower-mv__photo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-recruit.jpg" alt="ノートパソコンで作業をするHreedのメンバー">
        </div>

        <svg width="56" height="124" viewBox="0 0 56 124" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--01" aria-hidden="true">
          <path class="js-draw" d="M54.838 46.5V123.5H28.664V100.352H0.5V46.5Z" stroke="#0C998A"/>
          <rect class="js-draw" x="0.5" y="0.5" width="25" height="25" stroke="#0C998A"/>
        </svg>
        <svg width="170" height="141" viewBox="0 0 170 141" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--02" aria-hidden="true">
          <path class="js-draw" d="M75.825 70.297V0.5H150.15V74.825H106.614V106.614H0.5V70.297Z" stroke="#0C998A"/>
          <circle class="js-draw" cx="150.5" cy="121.143" r="19" stroke="#0C998A"/>
        </svg>
        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--03" aria-hidden="true">
          <rect class="js-draw" x="0.5" y="0.5" width="43" height="43" stroke="#0C998A"/>
        </svg>
        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--04" aria-hidden="true">
          <circle class="js-draw" cx="28" cy="28" r="27.5" stroke="#0C998A"/>
        </svg>
      </div>
    </section>

    <!-- ================= Lead ================= -->
    <section class="recruit-lead">
      <div class="recruit-lead__inner inner">
        <p class="recruit-lead__position">キャリアアドバイザー／リクルーティングアドバイザー</p>
        <h2 class="recruit-lead__heading">
          一人ひとりのキャリアに伴走する、<br class="pc"><span class="recruit-lead__heading-accent">“キャリアパートナー”</span>を募集しています。
        </h2>
        <p class="recruit-lead__text">
          単なるマッチングではなく、候補者一人ひとりの価値観や強みを引き出し、最適なキャリアの実現を伴走する。<br class="pc">
          そんな“キャリアパートナー”的な役割を担っていただきます。
        </p>

        <ul class="recruit-lead__tags">
          <li class="recruit-lead__tag">20代・未経験歓迎</li>
          <li class="recruit-lead__tag">学歴不問</li>
          <li class="recruit-lead__tag">年間休日125日</li>
          <li class="recruit-lead__tag">リモートワーク制度あり</li>
          <li class="recruit-lead__tag">フレックス制度あり</li>
        </ul>
      </div>
    </section>

    <!-- ================= Appeal ================= -->
    <section class="recruit-appeal">
      <div class="inner">
        <div class="recruit-appeal__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Appeal</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">このポジションの魅力</span></p>
        </div>

        <ul class="recruit-appeal__list">
          <?php foreach ($recruit_appeals as $i => $appeal) : ?>
          <li class="recruit-appeal__item">
            <span class="recruit-appeal__num"><?php echo sprintf('%02d', $i + 1); ?></span>
            <h3 class="recruit-appeal__title"><?php echo esc_html($appeal['title']); ?></h3>
            <p class="recruit-appeal__text"><?php echo esc_html($appeal['text']); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <!-- ================= Work ================= -->
    <section class="recruit-work">
      <div class="inner">
        <div class="recruit-work__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Work</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">仕事内容</span></p>
        </div>

        <div class="recruit-work__row">
          <div class="recruit-work__photo">
            <img class="recruit-work__photo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/about-photo-sub.jpg" alt="ノートパソコンで作業をするメンバーの手元" loading="lazy">
          </div>

          <div class="recruit-work__business">
            <div class="recruit-work__business-item">
              <h3 class="recruit-work__business-title">採用コンサルティング事業</h3>
              <p class="recruit-work__business-text">
                採用にまつわる人員計画の策定から予算、ワークフロー、運用計画の設計や実際の運用と振り返りまでを一気通貫で支援しています。お悩みのポイントがある企業様に関しては、スポットでの支援も実施しています。
              </p>
            </div>
            <div class="recruit-work__business-item">
              <h3 class="recruit-work__business-title">人材紹介事業</h3>
              <p class="recruit-work__business-text">
                主に中途領域での人材紹介事業を行っています。転職伴走サービスとして候補者の入社後活躍にこだわったマッチングの支援に取り組み、入社後の短期離職は0%。企業・転職者双方にメリットのある転職支援を実現していきます。
              </p>
            </div>
          </div>
        </div>

        <div class="recruit-work__tasks">
          <h3 class="recruit-work__tasks-title">具体的な業務内容</h3>
          <ul class="recruit-work__tasks-list">
            <?php foreach ($recruit_tasks as $task) : ?>
            <li class="recruit-work__tasks-item"><?php echo esc_html($task); ?></li>
            <?php endforeach; ?>
          </ul>
          <p class="recruit-work__note">※業務内容の変更範囲：会社の定める業務の範囲</p>
        </div>
      </div>
    </section>

    <!-- ================= Person ================= -->
    <section class="recruit-person">
      <div class="inner">
        <div class="recruit-person__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Person</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">求める人物像</span></p>
        </div>

        <ul class="recruit-person__list">
          <?php foreach ($recruit_persons as $person) : ?>
          <li class="recruit-person__card">
            <h3 class="recruit-person__title"><?php echo esc_html($person['title']); ?></h3>
            <ul class="recruit-person__items">
              <?php foreach ($person['items'] as $item) : ?>
              <li class="recruit-person__item"><?php echo esc_html($item); ?></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <!-- ================= Requirements ================= -->
    <section class="recruit-requirements">
      <div class="inner">
        <div class="recruit-requirements__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Requirements</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">募集要項</span></p>
        </div>

        <dl class="recruit-table">
          <div class="recruit-table__row">
            <dt class="recruit-table__label">募集職種</dt>
            <dd class="recruit-table__value">キャリアアドバイザー／リクルーティングアドバイザー</dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">雇用形態</dt>
            <dd class="recruit-table__value">
              正社員（中途採用）<br>
              試用期間：6カ月
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">応募資格</dt>
            <dd class="recruit-table__value">
              <ul class="recruit-table__list">
                <li>社会人経験2年以上</li>
                <li>無形商材の提案営業経験（キャリアアドバイザー経験は不問）</li>
              </ul>
              <p class="recruit-table__sub">学歴不問／職種・業種未経験OK</p>
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">給与</dt>
            <dd class="recruit-table__value">
              月給32万円〜50万円（想定年収400万円〜600万円）<br>
              賞与：業績賞与（昨年度実績 1カ月分）<br>
              インセンティブ：あり
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">勤務地</dt>
            <dd class="recruit-table__value">
              クロスコープ渋谷ネクストサイトオフィス<br>
              〒150-0002<br>
              東京都渋谷区渋谷2-12-4 ネクストサイト渋谷ビル 5F<br>
              転勤：なし
              <p class="recruit-table__sub">※勤務地の変更範囲：会社の定める勤務地の範囲</p>
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">勤務時間</dt>
            <dd class="recruit-table__value">
              10:00〜19:00<br>
              月間平均残業時間：20時間以下
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">休日休暇</dt>
            <dd class="recruit-table__value">
              土日祝休み（年間休日125日）<br>
              有給休暇、夏季休暇、年末年始休暇、GW休暇、産休・育休
            </dd>
          </div>

          <div class="recruit-table__row">
            <dt class="recruit-table__label">福利厚生</dt>
            <dd class="recruit-table__value">
              社会保険完備、健康診断、交通費支給、役職手当<br>
              リモートワーク制度あり<br>
              フレックス制度あり
            </dd>
          </div>
        </dl>
      </div>
    </section>

    <!-- ================= Flow ================= -->
    <section class="flow recruit-flow">
      <div class="inner">
        <div class="flow__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Flow</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">選考の流れ</span></p>
        </div>

        <ol class="flow__list">
          <?php foreach ($recruit_steps as $i => $step) : ?>
          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle"><?php echo $i + 1; ?></span>
              <img class="flow__num-arrow" src="<?php echo get_template_directory_uri(); ?>/img/service/arrow-bottom.svg" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title"><?php echo esc_html($step['title']); ?></p>
              <p class="flow__text"><?php echo wp_kses($step['text'], ['span' => ['class' => []]]); ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <!-- ================= Entry ================= -->
    <section class="recruit-entry">
      <div class="recruit-entry__inner inner">
        <div class="recruit-entry__head sec-title sec-title--reverse">
          <h2 class="sec-title__en"><span class="sec-title__text">Entry</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">エントリー</span></p>
        </div>

        <p class="recruit-entry__text">
          ご応募は、お問い合わせフォームから受け付けています。<br class="pc">
          少しでも興味をお持ちいただけたら、お気軽にエントリーください。
        </p>

        <?php // お問い合わせフォームの種別を「採用について」が選ばれた状態で開く(js/script.js) ?>
        <a href="<?php echo esc_url(home_url('/contact/?subject=recruit')); ?>" class="recruit-entry__btn btn-more">
          エントリーフォームへ進む
          <span class="btn-more__arrow" aria-hidden="true">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
        </a>
      </div>
    </section>

    <!-- ================= Link cards (Service / Company) ================= -->
    <?php get_template_part('template-parts/link-cards', null, ['cards' => ['service', 'company']]); ?>

    <!-- ================= CTA banner (Contact) ================= -->
    <?php get_template_part('template-parts/cta-banner'); ?>
  </main>

<?php get_footer(); ?>
