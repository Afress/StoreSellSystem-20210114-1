# 手機配件銷售與倉庫管理系統

以 PHP ＋ MySQL 為手機配件零售店打造的銷售、庫存與叫貨管理網站。本版為**作品集展示用快照**，保留 2021 年交件原貌，未做任何重構或美化。

- 時間：2021 年 1 月（期末）
- 團隊：三人（期末報告書三十二頁；因內含團員姓名與學號，報告書不上傳，僅公開原始碼展示）
- 我的職責：網頁設計、網頁前端與後端實作（依報告書工作分配表）
- 環境：Apache（XAMPP）＋ MariaDB 10.4 ＋ PHP 8，phpMyAdmin 5.0.4 傾印

## 專案背景

以台南在地手機配件零售店的實際營運流程為範本。店家原本以紙本紀錄銷售與庫存，資料不同步、人為疏失、紙本耗材與保管安全都是問題。系統將七個核心流程電腦化：

| # | 功能 | 對應頁面 | 資料庫行為 |
|---|------|----------|-----------|
| 1 | 商品建檔 | `sell_itemInfo/` | `sell_item` 新增／修改／刪除／查詢，條碼 `CHAR(15)` 為主鍵 |
| 2 | 商品上下架 | `updateSelling.php` | `item_state` 0↔1 切換，下架商品不再出現在銷售選單 |
| 3 | 銷售登記 | `sale_record/addSaleRecord.php` | 寫入銷售主檔 `sale_record` 與單筆明細 `sell_detail`，庫存同步 `item_num − 1` |
| 4 | 建立叫貨單 | `supply_orderInfo/addSupplyOrderInfo.php` | 寫入 `supply_order` 與索引表 `supply_index` |
| 5 | 回報廠商 | 叫貨單列表 | `purchase_state = 2` |
| 6 | 到貨確認 | `updateState.php` | 狀態 0/2 → 1，庫存同步 `item_num ＋ purchase_num`；已到貨（1）者拒絕重複確認 |
| 7 | 廠商建檔 | `factoryInfo/` | `factory` ＋ `factory_detail`（聯絡人） |

入口：`ManageSystem/sellGoods.html`（卡片式選單）。

## 資料庫設計（本專題主軸）

七張表全部 InnoDB／utf8mb4。設計流程：企業訪談 → 功能需求 → 資料流程圖 → E-R 模型 → 正規化 → 實體結構與索引。

```text
sell_item        商品（item_barcode 主鍵，庫存 item_num，售價，上下架 item_state）
sale_record      銷售主檔（sale_recordNum CHAR(6) 主鍵，sale_date）
sell_detail      銷售明細（item_barcode ＋ sale_recordNum 複合主鍵，兩個外鍵）
supply_order     叫貨單（purchase_code CHAR(6) 主鍵，數量／批發價／狀態 0未到 1已到 2已回報）
supply_index     叫貨單—商品索引（複合主鍵）
factory          廠商（factory_name 主鍵，factory_phone）
factory_detail   廠商聯絡人（factory_phone 主鍵，factory_person）
```

- 所有外鍵採 `ON DELETE/UPDATE CASCADE`：銷售主檔刪除時明細連動消失，商品改名時叫貨單同步。
- `sell_detail` 為「單筆明細＝一件商品」的粒度，配合庫存逐件扣減。
- `item_selling`、`purchase_checkID` 為課程時期的自參考欄位（外鍵指回本表主鍵，示範資料值與主鍵相同），保留原貌。
- 傾印含示範資料：10 商品／12 筆銷售／11 張叫貨單／10 家廠商，廠商名稱與電話皆為虛構。

## 快速開始

1. 安裝 XAMPP（Apache ＋ MySQL/MariaDB ＋ PHP）。
2. 將 `ManageSystem/` 放進 `htdocs/`。
3. 在 phpMyAdmin 匯入 `productmanage.sql`（建立 `productmanage` 資料庫、七張表與示範資料）。
4. 建立與程式連線參數一致的 MySQL 帳號：使用者 `manager`、密碼 `gsshop2020`，授與 `productmanage.*` 權限（連線參數寫死在 PHP 檔內，為 2021 交件原貌，未抽除）。
5. 瀏覽器開啟 `http://localhost/ManageSystem/sellGoods.html`。

## 目錄結構

```text
productmanage.sql          phpMyAdmin 傾印（結構與示範資料）
ManageSystem/
├─ sellGoods.html          入口卡片選單
├─ sell_itemInfo/          商品管理、上下架
├─ sale_record/            銷售紀錄與新增
├─ supply_orderInfo/       叫貨單、到貨確認
├─ factoryInfo/            廠商管理
├─ css/                    版型（含內嵌的 Bootstrap 4.4.1）與圖片
├─ addGuestbook.php        ┐
├─ newArticle.php          ├ 非本系統功能的殘留檔案，保留存檔（見下方說明）
└─ received.php            ┘
```

二十一個 PHP 檔案皆為程序式 PHP ＋ `mysqli`，無框架、無物件模型，每個頁面自行開啟資料庫連線。

## 已知限制（誠實列示，未修正）

- **無登入與權限**：區域網路示範場景的設計，任何人都能操作全部頁面。
- **SQL 皆字串直拼、未使用參數化查詢**，存在注入風險——交件原貌，刻意不改寫以保持歷史真實。
- **庫存更新為「先讀後寫」**（先 `SELECT` 再 `UPDATE`），無交易或鎖，併發下可能不一致；單店單機情境下可接受。
- **單號以筆數＋1 生成**，刪除單據後會重複撞號（示範資料未觸發此路徑）。
- **三個殘留檔案**（`addGuestbook.php`／`newArticle.php`／`received.php`）屬外來範例殘留：連線另一組不存在於本結構的資料庫（含空密碼 `root` 的連線範例）、引用不存在的頁面。保留以顯示專案原貌，不屬於系統功能，開啟這些頁面時預期報錯。
- 版型圖片有多份 103 KB 重複副本（各模組 css 下同圖），屬存檔體積的權宜之計。
- 無自動化測試、無介面服務、無響應式設計：2021 年交付物即為區域網路內的網頁展示。

## 授權

未宣告授權條款；內嵌第三方僅 `css/bootstrap-4.4.1.css`（Bootstrap 4.4.1，MIT 授權）。
