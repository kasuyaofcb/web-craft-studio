# よく使うIssueセット

このファイルは、テンプレートプロジェクトでよく使うIssueのセットを定義しています。

## 模写コーディングフェーズ用Issueセット

以下のセクションは、多くのプロジェクトで共通して使用されます。
プロジェクトに合わせてカスタマイズしてください。

### デフォルトセット（Web Craft Studio TOPページ）

```text
- ヘッダー
- TOPページ ファーストビュー（FV）
- TOPページ サービスセクション
- TOPページ 制作実績セクション
- TOPページ スタッフセクション
- TOPページ お客様の声セクション
- TOPページ 最新のお知らせセクション
- TOPページ お問い合わせセクション
- フッター
```

### カスタマイズ方法

`.github/scripts/create-markup-issues.sh` または `.github/scripts/create-markup-issues.js` の `SECTIONS` 配列を編集してください。

## WordPress化フェーズ用Issueセット

```text
- テーマの基本構造作成
- 固定ページ実装（TOP）
- 固定ページ実装（About）
- 固定ページ実装（Contact）
- カスタム投稿タイプ実装（Works）
- ヘッダー・フッターのWordPress化
```

## 使い方

1. プロジェクトをコピー後、`.github/scripts/` ディレクトリに移動
2. セクション一覧をプロジェクトに合わせて編集（必要に応じて）
3. スクリプトを実行してIssueを一括作成

詳細は [Issue一括作成スクリプトのREADME](.github/scripts/README.md) を参照してください。
