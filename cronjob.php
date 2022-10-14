#!/usr/bin/env php
<?php declare(strict_types=1);

date_default_timezone_set('Europe/Stockholm');

class Cheevo
{
	public function __construct(
		public int $id,
		public string $name,
		public int $XP,
		public ?string $description,
		public int $day,
		public int $month,
		public string $slug,
		public ?string $message = null,
	)
	{}
}

$cheevos = [
	new Cheevo(84, "First Blood", 1500, "Lagt en order den 1:a januari", 1, 1, "first_blood"),
	new Cheevo(321, "Very Valentine", 2500, "Hämtat ut order på alla hjärtans dag", 14, 2, "very_valentine"),
	new Cheevo(1020, "Honor the Fallen", 1000, "Köpt en Apple-produkt på Steve Jobs födelsedag", 24, 2, "honor_the_fallen", "Köp en Apple-produkt idag ({today})"),
	new Cheevo(1165, "Mar10", 1000, "Köpt en Super Mario-produkt den 10:e mars", 10, 3, "mar10"),
	new Cheevo(760, "Pi-Day!", 1500, "Köpt Raspberry Pi 14:e mars", 14, 3, "pi-day", "Köp en Raspberry Pi idag ({today})"),
	new Cheevo(754, "May the 4th Be With You", 1000, null, 4, 5, "may_the_4th_be_with_you", "Köp en Star Wars-produkt idag ({today})"),
	new Cheevo(647, "Guten Tag!", 1000, "Lagt en order 5:e maj. Wolfstein 3D släpps till MS-DOS (1992)", 5, 5, "guten_tag"),
	new Cheevo(1211, "GSMDay", 1000, "Handlat på GSMHackers födelsedag!", 12, 5, "gsmday"),
	new Cheevo(1039, "Happy Birthday Nelson", 1000, "Handlat på Nelsons födelsedag, 25 maj", 25, 5, "happy_birthday_nelson"),
	new Cheevo(920, "Trumpuuuu", 1000, "Handlat den 14:e Juni", 14, 6, "trumpuuuu"),
	new Cheevo(644, "The Slipgate Complex", 1000, "Lagt en order 22:a juni. Quakes födelsedag (1996)", 22, 6, "the_slipgate_complex"),
	// TODO A May Pole, in June
	new Cheevo(714, "Umbasa", 1000, "Lagt en order 25:e juni. Demon's Souls släpps till PS3 i Sverige (2010)", 25, 6, "umbasa"),
	new Cheevo(1157, "Alternative Pi Day!", 1500, "22/7 = 3.14", 22, 7, "alternative_pi_day"),
	new Cheevo(617, "Hidden and Dangerous XP Bonus", 1000, "Lagt en order den 29:e juli. Hidden and Dangerous födelsedag", 29, 7, "hidden_and_dangerous_xp_bonus"),
	new Cheevo(1318, "You're a Wizard, Harry", 1000, "Köpt/beställt Harry Potter-produkt på Harry Potters födelsedag, den 31 juli (1980)", 31, 7, "youre_a_wizard_harry"),
	new Cheevo(615, "PC Day Celebration!", 1000, "Lagt en beställning 12/8 (IBM introducerade persondatorn)", 12, 8, "pc_day_celebration"),
	new Cheevo(616, "Big Boss XP Boost", 1000, "Lagt en order den 24:e augusti. Hideo Kojimas födelsedag", 24, 8, "big_boss_xp_boost"),
	new Cheevo(646, "It's Destiny", 1000, "Lagt en beställning 9/9 (Destiny lanserades 9 sep 2014)", 9, 9, "its_destiny"),
	// TODO Wind of Change
	new Cheevo(1313, "Test Your Might", 1000, "Lagt en order den 8 oktober. Mortal Kombats födelsedag (1992)", 8, 10, "test_your_might"),
	new Cheevo(1314, "Wololo", 1000, "Lagt en order den 15 oktober. Age of Empires födelsedag (1997)", 15, 10, "wololo"),
	new Cheevo(1315, "Greedy Reptilians", 1000, "Köpt Microsoft-produkt på Bill Gates födelsedag (28 oktober)", 28, 10, "greedy_reptilians"), // behöver riktiga description
	new Cheevo(1316, "Press F", 1000, "Lagt en order den 29 oktober. Call of Dutys födelsedag (2003)", 29, 10, "press_f"),
	new Cheevo(1106, "Shopping for One", 1000, "Handlat på Singles Day", 11, 11, "shopping_for_one"),
	new Cheevo(643, "BFG9000", 1000, "Lagt en order 10:e december. Dooms födelsedag (1993)", 10, 12, "bfg9000"),
	new Cheevo(686, "Lucy Liu", 1000, "Handlat på lucia (2015-)", 13, 12, "lucy_liu"),
	new Cheevo(645, "The Dopefish Lives", 1000, "Lagt en order 14:e december. Commander Keens födelsedag (1993)", 14, 12, "the_dopefish_lives"),
	new Cheevo(85, "The Optimist", 2500, "Lagt en order (postorder) 22:a eller 23:e december", 22, 12, "the_optimist", "Postordra något idag eller imorgon (22-23 december)"),
	new Cheevo(687, "Maybe Next Year, Santa...", 1000, "Lagt en order på julafton (2015-)", 24, 12, "maybe_next_year_santa"),
	new Cheevo(1317, "Fudge You", 1000, "Lagt en order den 28 december. Linus Torvalds födelsedag (1969)", 28, 12, "fudge_you"),
	new Cheevo(688, "Same Procedure as Last Year?", 1000, "Lagt en order på nyårsafton (2015-)", 31, 12, "same_procedure_as_last_year"),
];

$month = date('m');
$day = date('d');

$cheevo_today = null;
foreach ($cheevos as $cheevo) {
	if ($month == $cheevo->month and $day == $cheevo->day) {
		$cheevo_today = $cheevo;
		break;
	}
}

if ( ! is_null($cheevo_today)) {
	$cheevo = $cheevo_today;
	$XP = number_format($cheevo->XP, 0, ',', ' ');

	$formatter = new IntlDateFormatter('sv_SE', IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, null, 'd MMMM');
	$todaystr = $formatter->format(strtotime("{$cheevo->month}/{$cheevo->day}"));

	$message = $cheevo->message;
	if (is_null($message)) {
		$message = "Beställ något idag ($todaystr)";
	} else {
		$message = str_replace('{today}', $todaystr, $message);
	}

	$discord_role_id = getenv('DISCORD_ROLE_ID');
	$content = "$message för cheevon _{$cheevo->name}_ och $XP XP!". ($discord_role_id ? " <@&$discord_role_id>" : '');

	$json = [
		"content" => $content,
		"embeds" => [
			[
				"title" => "$XP XP",
				"description" => $cheevo->description,
				"color" => 1791,
				"fields" => [
					[
						"name" => "Kolla om du har cheevon:",
						"value" => "https://tsjo.st/wh/cheevo.php?id=". $cheevo->id,
					],
				],
				"author" => [
					"name" => $cheevo->name,
				],
				"image" => [
					"url" => $cheevo->slug ? "https://cdn.webhallen.com/img/member/achievements/{$cheevo->slug}_big.png" : null,
				],
			],
		],
	];

	$url = getenv('DISCORD_WEBHOOK');
	$c = curl_init($url .'?wait=true');
	$o = [
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => 'payload_json='. urlencode(json_encode($json)),
		CURLOPT_CUSTOMREQUEST => 'POST',
	];
	curl_setopt_array($c, $o);
	$ret = curl_exec($c);
	curl_close($c);
}
