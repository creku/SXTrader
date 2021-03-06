<?php
/*
 * Created on 24.07.2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class LSHistoricDataStatistic
 {
 	private /*LSHistoricMatch*/ $_direct = array();
 	private /*LSHistoricMatch*/ $_teamA = array();
 	private /*LSHistoricMatch*/ $_teamB = array();
 	
  private function xmlEntities($str)
  {
	$xml = array('&#34;','&#38;','&#38;','&#60;','&#62;','&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;');
	$html = array('&quot;','&amp;','&amp;','&lt;','&gt;','&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
	$str = str_replace($html,$xml,$str);
	$str = str_ireplace($html,$xml,$str);
	return $str;
  	}  	 	
 	public function __construct($direct, $teamA, $teamB)
 	{
 		$this->_direct = $direct;
 		$this->_teamA = $teamA;
 		$this->_teamB = $teamB;
 	}
 	
 	public function buildXML()
 	{
 		$doc = new DOMDocument('1.0', 'UTF-8');
  		$doc->formatOutput = true;  
  		$r = $doc->createElement( "root" );
  		$doc->appendChild( $r );
  		
  		$directNode = $doc->createElement("directMatches");
  		foreach($this->_direct as $match)
  		{
  			$matchNode = $this->createMatchNode($doc, $match);
  			
  			$directNode->appendchild($matchNode);
  		}
  		$r->appendChild($directNode);
  		
  		$teamANode = $doc->createElement("teamAMatches");
  		foreach($this->_teamA as $match)
  		{
  			$matchNode = $this->createMatchNode($doc,$match);
  			
  			$teamANode->appendChild($matchNode);
  		}
  		$r->appendChild($teamANode);
  		
  		$teamBNode = $doc->createElement("teamBMatches");
  		foreach($this->_teamB as $match)
  		{
  			$matchNode = $this->createMatchNode($doc,$match);
  			
  			$teamBNode->appendChild($matchNode);
  		}
  		$r->appendChild($teamBNode);  		
  		
  		return $doc->saveXML();
 	}
 	
 	private function createMatchNode($doc, $match)
 	{
			$matchNode = $doc->createelement("match");
  			
  			// Attribute Spiel Id
  			$attrMatchId = $doc->createAttribute("matchId");
  			$attrMatchId->value = $match->MatchId;
  			$matchNode->appendChild($attrMatchId);
  			
  			// Attribute MatchDate
  			$attrMatchDate = $doc->createAttribute("matchDate");
  			$attrMatchDate->value = $match->MatchDate;
  			$matchNode->appendChild($attrMatchDate);
  			
  			// Team A Id
  			$attrTeamAId = $doc->createAttribute("teamAId");
  			$attrTeamAId->value = $match->TeamAId;
  			$matchNode->appendChild($attrTeamAId);
  			
  			// Team B Id
  			$attrTeamBId = $doc->createAttribute("teamBId");
  			$attrTeamBId->value = $match->TeamBId;
  			$matchNode->appendChild($attrTeamBId);
  			
  			// Team A Name
  			$attrTeamA = $doc->createAttribute("teamA");
  			$attrTeamA->value = htmlentities($match->TeamA);
  			//$attrTeamA->value = $match->TeamA;
  			//$attrTeamA->value = mb_convert_encoding($match->TeamA,'UTF-8','ISO-8859-1');
  			$matchNode->appendChild($attrTeamA);
  			
  			// Team B Name
  			$attrTeamB = $doc->createAttribute("teamB");
  			$attrTeamB->value = htmlentities($match->TeamB);
  			//$attrTeamB->value = mb_convert_encoding($match->TeamB,'UTF-8','ISO-8859-1');
  			//$attrTeamB->value = $match->TeamB;
  			$matchNode->appendChild($attrTeamB);
  			
  			// Liga/Wettkampf
  			$attrDevision = $doc->createAttribute("devision");
  			$attrDevision->value = $match->Devision;
  			$matchNode->appendChild($attrDevision);
  			
  			// Torstand Team A
  			$attrScoreA = $doc->createAttribute("scoreA");
  			$attrScoreA->value = $match->ScoreA;
  			$matchNode->appendChild($attrScoreA);
  			
  			// Torstand Team B
  			$attrScoreB = $doc->createAttribute("scoreB");
  			$attrScoreB->value = $match->ScoreB;
  			$matchNode->appendChild($attrScoreB);
  			
  			// Halbzeitstand
  			$attrHTScore = $doc->createAttribute("htScore");
  			$attrHTScore->value = $match->HalfTimeScore;
  			$matchNode->appendChild($attrHTScore); 	
  			
  			// Spielereignisse
  			$eventsNode = $doc->createElement("matchEvents");
  			foreach($match->MatchEventList as $event)
  			{
  				$eventNode = $this->createMatchEventNode($doc, $event);
  				$eventsNode->appendChild($eventNode);
  			}
  			$matchNode->appendChild($eventsNode);
  			
  			return $matchNode;	
 	}
 	
 	private function createMatchEventNode($doc, $event)
 	{
 		$eventNode = $doc->createElement("matchEvent");
 		
 		// Spiel Id
  		$attrMatchId = $doc->createAttribute("matchId");
  		$attrMatchId->value = $event->MatchId;
  		$eventNode->appendChild($attrMatchId);
  		
  		// Team Id
  		$attrTeamId = $doc->createAttribute("teamId");
  		$attrTeamId->value = $event->TeamId;
  		$eventNode->appendChild($attrTeamId);
  		
  		// Ereignistyp
  		$attrEventType = $doc->createAttribute("eventType");
  		$attrEventType->value = $event->EventType;
  		$eventNode->appendChild($attrEventType);
  		
  		// Info Event 1
  		$attrInfoEvent1 = $doc->createAttribute("infoEvent1");
  		//$attrInfoEvent1->value = $this->xmlEntities(htmlentities($event->InfoEvent1));
  		$attrInfoEvent1->value = $event->InfoEvent1;
  		$eventNode->appendChild($attrInfoEvent1);
  		
  		// Info Event 2
  		$attrInfoEvent2 = $doc->createAttribute("infoEvent2");
  		//$attrInfoEvent2->value = $this->xmlEntities(htmlentities($event->InfoEvent2));
  		$attrInfoEvent2->value = htmlentities($event->InfoEvent2);
  		$eventNode->appendChild($attrInfoEvent2);
  		
  		// Ereigniszeit
  		$attrEventMinute = $doc->createAttribute("eventMinute");
  		$attrEventMinute->value = $event->EventMinute;
  		$eventNode->appendChild($attrEventMinute);
  		 		
 		return $eventNode;
 	}
 }
 

?>
