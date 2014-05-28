<?php
/**
 * helper class to export tweet analyses
 * 
 * @author Andreas Ressmann
 * 24.05.2014 
 */
class Core_Exporthelper {
	public static function doExport ($analysisId) {
		
		$query = 'select * from analysis_tweets at
					inner join analysis a on a.id = at.analysis_id
					inner join tweet_entry t on t.id = at.tweet_id
					inner join event e on e.id = a.event_id
					left join filter f on f.id = a.filter_id
					where at.analysis_id = ' . $analysisId;
		
		$dbAdapter = Zend_Registry::getInstance()->dbAdapter;
		
		$result = $dbAdapter->fetchAll($query);
		
		$head = array ('Analyse Date', 'Filter Name', 'Filter Tags', 'Event Title', 'Tweet Text', 'Tweet Weight');
		
        $rows[] = $head;
        
        foreach ($result as $row) {
            $rows[] = array ($row["analysis_date"], $row["filter_name"], $row["filter_tags"], 
                            $row["event_title"], $row["tw_text"], $row["tw_weight"]);
        }
        
        $csv = '';
        foreach($rows as $row) {
            $csv .= implode(';', str_replace('.', ',', $row)) . "\n";
        }
        
        $file = 'analyse_export.csv';
        header("Content-Type: text/csv;charset=utf-8" );
        header("Content-Disposition: attachment;filename=\"$file\"" );
        header("Pragma: no-cache");
        header('Content-Length', strlen($csv));
        echo $csv;
        exit();
		
	}
}