# コーディングルール

## Git運用
- `main`ブランチには他のメンバーも随時プッシュするため、Claude Codeは**`main`に直接コミット・プッシュ・マージしない**。
- 作業を始める前に、必ず`main`から作業用ブランチを新規作成する。
  - ブランチ名は `claude/YYYYMMDD-作業内容の要約`(例: `claude/20260912-header-layout-fix`)とする。
  - 新しいチャット・セッションを開始した場合も、既存の作業用ブランチを使い回さず、その都度新しいブランチを作成する(前セッションの変更と混ざらないようにするため)。
- 変更は作業用ブランチにコミット・プッシュし、`main`へは反映しない。
  - `main`への取り込みが必要な場合は、Pull Requestを作成してユーザーのレビュー・マージを待つ。Claude Code側から`main`へのマージは行わない。
- プッシュ前に`git fetch`等で`origin/main`の最新状態を確認し、作業用ブランチが`main`から派生した最新の状態になっているか意識する。

## レイアウト・余白
- 原則、`height`は指定しない。余白は`padding`で取る。
- カード群など高さを揃える必要がある箇所に限り、`min-height`は使用してよい。
- `padding`・`margin`は、原則一番外側の要素につける。
- `padding`・`margin`は、`top`・`left`を優先する。

## 配置
- `absolute`による絶対配置は最終手段とする。
- できる限り`flexbox`または`grid`レイアウトを使用する。

## スライダー
- スライドショー、無限ループスライダーが発生する箇所は`swiper.js`を使用する。

## CSS / SCSS
- `.css`ファイルは直接編集しない。必ず`.scss`ファイルを編集する。
- SCSSはネストを使わない。
  - ただし`hover`や擬似要素(`::before`, `::after`等)はネストを使用してよい。
- コードはBEMで記述する。
- font周りは`@include font(size, line-height, letter-spacing, weight);`のmixinを使用する。アニメかけて。

## レスポンシブ
- SPファーストでコーディングする。
- レスポンシブは、同じクラスのブロック内に`@include mq()`で書く。クラス名を分けたり、同じクラスのスタイルを複数箇所に分割して書いたりしない。

**正しい例**
```scss
.mv__sub {
  font-family: $en;
  @include font(16, 19, null, $light);
  color: $white;
  text-align: center;

  @include mq("md") {
    @include font(28, 33);
  }
}
```

**間違った例**
```scss
.mv__sub {
  font-family: $en;
  @include font(16, 19, null, $light);
  color: $white;
  text-align: center;
}

@include mq("md") {
  .mv__sub {
    @include font(28, 33);
  }
}
```
