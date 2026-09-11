# コーディングルール

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
