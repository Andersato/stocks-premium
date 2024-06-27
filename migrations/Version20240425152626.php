<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425152626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_item ADD attribute_name VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE information_stock ADD index_name VARCHAR(30) DEFAULT NULL, ADD market_cap DOUBLE PRECISION DEFAULT NULL, ADD option_short VARCHAR(20) DEFAULT NULL, ADD sales_surprise DOUBLE PRECISION DEFAULT NULL, ADD sma20 DOUBLE PRECISION DEFAULT NULL, ADD sma50 DOUBLE PRECISION DEFAULT NULL, ADD sma200 DOUBLE PRECISION DEFAULT NULL, ADD eps_surprise DOUBLE PRECISION DEFAULT NULL, ADD eps_this_year DOUBLE PRECISION DEFAULT NULL, ADD eps_past5_year DOUBLE PRECISION DEFAULT NULL, ADD eps_next_gyear DOUBLE PRECISION DEFAULT NULL, ADD eps_next5_year DOUBLE PRECISION DEFAULT NULL, ADD sales_past5_year DOUBLE PRECISION DEFAULT NULL, ADD eps_yyttm DOUBLE PRECISION DEFAULT NULL, ADD sales_yyttm DOUBLE PRECISION DEFAULT NULL, ADD eps_qq DOUBLE PRECISION DEFAULT NULL, ADD sales_qq DOUBLE PRECISION DEFAULT NULL, ADD insider_own DOUBLE PRECISION DEFAULT NULL, ADD insider_trans DOUBLE PRECISION DEFAULT NULL, ADD inst_own DOUBLE PRECISION DEFAULT NULL, ADD inst_trans DOUBLE PRECISION DEFAULT NULL, ADD roa DOUBLE PRECISION DEFAULT NULL, ADD roe DOUBLE PRECISION DEFAULT NULL, ADD roi DOUBLE PRECISION DEFAULT NULL, ADD gross_margin DOUBLE PRECISION DEFAULT NULL, ADD oper_margin DOUBLE PRECISION DEFAULT NULL, ADD profit_margin DOUBLE PRECISION DEFAULT NULL, ADD payout DOUBLE PRECISION DEFAULT NULL, ADD short_float DOUBLE PRECISION DEFAULT NULL, ADD high52_w DOUBLE PRECISION DEFAULT NULL, ADD low52_w DOUBLE PRECISION DEFAULT NULL, ADD perf_week DOUBLE PRECISION DEFAULT NULL, ADD perf_month DOUBLE PRECISION DEFAULT NULL, ADD perf_quarter DOUBLE PRECISION DEFAULT NULL, ADD perf_half_year DOUBLE PRECISION DEFAULT NULL, ADD perf_year DOUBLE PRECISION DEFAULT NULL, ADD perf_ytd DOUBLE PRECISION DEFAULT NULL, ADD change_today DOUBLE PRECISION DEFAULT NULL, ADD income DOUBLE PRECISION DEFAULT NULL, ADD sales DOUBLE PRECISION DEFAULT NULL, ADD shs_outstand DOUBLE PRECISION DEFAULT NULL, ADD shs_float DOUBLE PRECISION DEFAULT NULL, ADD short_interest DOUBLE PRECISION DEFAULT NULL, ADD avg_volume DOUBLE PRECISION DEFAULT NULL, ADD book_sh DOUBLE PRECISION DEFAULT NULL, ADD cash_sh DOUBLE PRECISION DEFAULT NULL, ADD per DOUBLE PRECISION DEFAULT NULL, ADD forward_per DOUBLE PRECISION DEFAULT NULL, ADD peg DOUBLE PRECISION DEFAULT NULL, ADD price_sales DOUBLE PRECISION DEFAULT NULL, ADD price_book DOUBLE PRECISION DEFAULT NULL, ADD price_cash DOUBLE PRECISION DEFAULT NULL, ADD price_free_cash_flow DOUBLE PRECISION DEFAULT NULL, ADD quick_ratio DOUBLE PRECISION DEFAULT NULL, ADD current_ratio DOUBLE PRECISION DEFAULT NULL, ADD debt_equity DOUBLE PRECISION DEFAULT NULL, ADD lt_debt_equity DOUBLE PRECISION DEFAULT NULL, ADD short_ratio DOUBLE PRECISION DEFAULT NULL, ADD rs114 DOUBLE PRECISION DEFAULT NULL, ADD recom DOUBLE PRECISION DEFAULT NULL, ADD rel_volume DOUBLE PRECISION DEFAULT NULL, ADD beta DOUBLE PRECISION DEFAULT NULL, ADD atr14 DOUBLE PRECISION DEFAULT NULL, ADD dividend_est DOUBLE PRECISION DEFAULT NULL, ADD dividend_ttm DOUBLE PRECISION DEFAULT NULL, ADD eps_ttm DOUBLE PRECISION DEFAULT NULL, ADD eps_next_year DOUBLE PRECISION DEFAULT NULL, ADD eps_next_quarter DOUBLE PRECISION NOT NULL, ADD target_price DOUBLE PRECISION DEFAULT NULL, ADD prev_close DOUBLE PRECISION DEFAULT NULL, ADD price DOUBLE PRECISION DEFAULT NULL, ADD dividend_ex_date DATE DEFAULT NULL, ADD earnings DATE DEFAULT NULL, ADD range52_w VARCHAR(30) DEFAULT NULL, ADD volatility VARCHAR(30) DEFAULT NULL, ADD volume DOUBLE PRECISION DEFAULT NULL, ADD employees INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_item DROP attribute_name');
        $this->addSql('ALTER TABLE information_stock DROP index_name, DROP market_cap, DROP option_short, DROP sales_surprise, DROP sma20, DROP sma50, DROP sma200, DROP eps_surprise, DROP eps_this_year, DROP eps_past5_year, DROP eps_next_gyear, DROP eps_next5_year, DROP sales_past5_year, DROP eps_yyttm, DROP sales_yyttm, DROP eps_qq, DROP sales_qq, DROP insider_own, DROP insider_trans, DROP inst_own, DROP inst_trans, DROP roa, DROP roe, DROP roi, DROP gross_margin, DROP oper_margin, DROP profit_margin, DROP payout, DROP short_float, DROP high52_w, DROP low52_w, DROP perf_week, DROP perf_month, DROP perf_quarter, DROP perf_half_year, DROP perf_year, DROP perf_ytd, DROP change_today, DROP income, DROP sales, DROP shs_outstand, DROP shs_float, DROP short_interest, DROP avg_volume, DROP book_sh, DROP cash_sh, DROP per, DROP forward_per, DROP peg, DROP price_sales, DROP price_book, DROP price_cash, DROP price_free_cash_flow, DROP quick_ratio, DROP current_ratio, DROP debt_equity, DROP lt_debt_equity, DROP short_ratio, DROP rs114, DROP recom, DROP rel_volume, DROP beta, DROP atr14, DROP dividend_est, DROP dividend_ttm, DROP eps_ttm, DROP eps_next_year, DROP eps_next_quarter, DROP target_price, DROP prev_close, DROP price, DROP dividend_ex_date, DROP earnings, DROP range52_w, DROP volatility, DROP volume, DROP employees');
    }
}
