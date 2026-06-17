<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $agents = [
            ['nom' => 'NIKIEMA', 'prenom' => 'LAURENT', 'email' => 'lnikiema9@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '77505873'],
            ['nom' => 'ZONGO', 'prenom' => 'BOUDOHIN FARIDA', 'email' => 'faridazongo96@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '60845717'],
            ['nom' => 'NARE', 'prenom' => 'WEND-KUNI MARIE ASTRIDE', 'email' => 'nare@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'SAWADOGO', 'prenom' => 'ADAMA', 'email' => 'adamadzenco@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '74732249'],
            ['nom' => 'OUGDA', 'prenom' => "SAID CHAM'S NOUR", 'email' => 'chamsougda@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '75799846'],
            ['nom' => 'KOUDOUGOU', 'prenom' => 'ALFRED WEND-KUNNI', 'email' => 'koudougou@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'RHASMATOU DIT BEBE', 'email' => 'rhasmatououedraogo@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66516299'],
            ['nom' => 'BADO', 'prenom' => 'XAVIER', 'email' => 'bado@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'KERE', 'prenom' => 'DAVID', 'email' => 'keredavid11@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '64872199'],
            ['nom' => 'TOU', 'prenom' => "PELE THOMAS D'AQUIN", 'email' => 'tou@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'SOMBIE', 'prenom' => 'BAPERMA MOHAMED', 'email' => 'mohamedsombie95@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '55565219'],
            ['nom' => 'SAWADOGO', 'prenom' => 'K. LESLIE ELYSE', 'email' => 'lesliesawadogo2856@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '70470384'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'KELEGWENDE FABIENNE LAURAINE', 'email' => 'fabienneouedra@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '221784718835'],
            ['nom' => 'TRAORE', 'prenom' => 'ZANGA ALI MOHAMED', 'email' => 'zangatraore14@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '70168465'],
            ['nom' => 'TARPILGA', 'prenom' => 'YACOUBA', 'email' => 'tar_yacouba@yahoo.com', 'structure' => 'ELITE IT', 'telephone' => '72334558'],
            ['nom' => 'SAWADOGO', 'prenom' => 'WEND KUUNI BONAVENTURE MARIE', 'email' => 'sawadogo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'DIANE ELODIE', 'email' => 'ouedraogodiane88@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '73378929'],
            ['nom' => 'NANA', 'prenom' => 'ADAMA', 'email' => 'adamanana31@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '72360391'],
            ['nom' => 'KAFANDO', 'prenom' => 'SIDBEWENDIN DONALD', 'email' => 'kafando.etude@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '55266972'],
            ['nom' => 'NAKANABO', 'prenom' => 'WEND-KUNNI GUY FABRICE', 'email' => 'nakanabo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'COULIBALY', 'prenom' => 'OUROBE DONATIEN', 'email' => 'odonatiencoulibaly@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '77647982'],
            ['nom' => 'OUATTARA', 'prenom' => 'KOUDOUSSOU', 'email' => 'ouattara@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'SANA', 'prenom' => 'CHEIK ABOUBAKAR SIDIKI', 'email' => 'sana@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'KABORE', 'prenom' => 'NOE EMMANUEL', 'email' => 'noemmanuel92@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '60332266'],
            ['nom' => 'ILBOUDO', 'prenom' => 'ALASSANE', 'email' => 'ilboudo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'LOMPO', 'prenom' => 'LIMABA', 'email' => 'lompo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'KABORE', 'prenom' => 'OUSSEINI IER JUMEAU', 'email' => 'kousseini1j@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '75240588'],
            ['nom' => 'DAMIBA', 'prenom' => 'DEBORAH S. MARIE PAMELLA', 'email' => 'damiba@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'BOUGMA', 'prenom' => 'SAOUDATA', 'email' => 'saoudatoubougma@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '76937324'],
            ['nom' => 'DJIGUIMDE', 'prenom' => 'R. CEDRIC SEVERIN', 'email' => 'cedricdjiguimde@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '77274113'],
            ['nom' => 'LENGANE', 'prenom' => 'ISSOUF', 'email' => 'isslengane@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '77588284'],
            ['nom' => 'AHAIZINTA', 'prenom' => 'LETICIA SEVERINE LAILA', 'email' => 'lailaahaizinta@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '55457360'],
            ['nom' => 'SOGOBA', 'prenom' => 'MAHAMADI', 'email' => 'sogobamahamadi35@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66069311'],
            ['nom' => 'KOUMBIA', 'prenom' => 'ZAINOUL ABDINE', 'email' => 'zkoumbiaa@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '62769699'],
            ['nom' => 'COMPAORE', 'prenom' => 'EZECHIEL SEVERIN W.', 'email' => 'cezechiel81@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '72553359'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'NATO ASSITA', 'email' => 'natoouedraogo@yahoo.fr', 'structure' => 'ELITE IT', 'telephone' => '72808662'],
            ['nom' => 'TAPSOBA', 'prenom' => 'ABDOUL-GANIHOU RAZACK', 'email' => 'tapsoba@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'TOUGMA', 'prenom' => 'MOHAMED', 'email' => 'mohamedyakeri@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '67929512'],
            ['nom' => 'KAMBOULE', 'prenom' => 'SANGOUMAN BERNARD', 'email' => 'sangoumank@protonmail.com', 'structure' => 'ELITE IT', 'telephone' => '57874687'],
            ['nom' => 'KOANDA', 'prenom' => 'ABDOULAH ARAFAT', 'email' => 'arafatkoanda01@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '62995550'],
            ['nom' => 'KOUANDA', 'prenom' => 'OUEDRAOGO ACHRAF ABDOUL M.', 'email' => 'achrafkouanda1911@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '51141148'],
            ['nom' => 'KIEBRE', 'prenom' => 'NEBNOMA EMMANUEL', 'email' => 'nemmanuelkiebre@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '64060184'],
            ['nom' => 'SANA', 'prenom' => 'ISSOUF', 'email' => 'sanaaissouf@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66605572'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'FATAO', 'email' => 'fataoouedraogo226@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '65516263'],
            ['nom' => 'WARMA', 'prenom' => 'MOHAMED', 'email' => 'mohamed.warma10@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '75461377'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'SOUTONGNOMA DIMITRI', 'email' => 'dimitriouedraogo9539@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '77454757'],
            ['nom' => 'TRAORE', 'prenom' => 'NICODEME JEAN CHEICK', 'email' => 'nicodemetraore18@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '75059161'],
            ['nom' => 'PAKODTOGO', 'prenom' => 'WENDPANGA JOEL', 'email' => 'pakodtogo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'ZONGO', 'prenom' => 'PINGD-WENDE CHRISTOPHE J.', 'email' => 'delanova1954@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '67406921'],
            ['nom' => 'SAWADOGO', 'prenom' => 'W. A. EPHRAIM', 'email' => 'sawadogoephraim2002@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '72620579'],
            ['nom' => 'ZOMBRE', 'prenom' => 'W-K. CHRISTIAN 2 EME J.', 'email' => 'christianzombre48@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '56223851'],
            ['nom' => 'PARE', 'prenom' => 'LAOPAN DAVID', 'email' => 'paredavid50@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '57186629'],
            ['nom' => 'SANOU', 'prenom' => 'DAKHO JEAN THIBAUT', 'email' => 'sanondakhojeanthibaut@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '74900303'],
            ['nom' => "N'DO", 'prenom' => 'BABOU RICHARD', 'email' => 'richardbabou09@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66656415'],
            ['nom' => 'COMPAORE', 'prenom' => 'IGNACE LANDRY', 'email' => 'landryovice@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '73757503'],
            ['nom' => 'BIDIMA', 'prenom' => 'ENOCH', 'email' => 'enoch.prnic7bidima@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '74497457'],
            ['nom' => 'DIMA', 'prenom' => 'ISSA', 'email' => 'issadima15@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '63944821'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'PARFAIT', 'email' => 'ouedraogoparfait17@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '63811881'],
            ['nom' => 'TAPSOBA', 'prenom' => 'ABDOUL AZIZ', 'email' => 'tapsosecure@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66016647'],
            ['nom' => 'BONZI', 'prenom' => 'PHILIPPE SOUMBOZA', 'email' => 'phillippe.bonzi@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '71980484'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'AISSATA', 'email' => 'ouedraogo8888@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '79678624'],
            ['nom' => 'SANOGO', 'prenom' => 'ABASS', 'email' => 'abass.sanogo@yahoo.com', 'structure' => 'ELITE IT', 'telephone' => '71606507'],
            ['nom' => 'DICKO', 'prenom' => 'AMADOU', 'email' => 'fayssaldickoamadou92@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66243042'],
            ['nom' => 'NIKIEMA', 'prenom' => 'M. W. EDMOND JUNIOR', 'email' => 'edmondj.nikiema@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '63216499'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'ABDOUL RAZAK NATEWENDE', 'email' => 'abdoulodg266@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66873889'],
            ['nom' => 'GNISSIEN', 'prenom' => 'LADJI', 'email' => 'gnissienladj@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '67993706'],
            ['nom' => 'SAMA', 'prenom' => 'ACHILLE', 'email' => 'chisleyachille@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '70427573'],
            ['nom' => 'GOUBA', 'prenom' => 'JERRY CEDRIC FIRIGNON', 'email' => 'goubacedric7@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '72079526'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'ADAMA IMAM MANEGA W.', 'email' => 'ouedraogoimam3@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '79790107'],
            ['nom' => 'CONGO', 'prenom' => 'BOUKARE', 'email' => 'Boukaricongo19@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '60105068'],
            ['nom' => 'DIARRA', 'prenom' => 'MOUSSA', 'email' => 'diarra@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'SANGO', 'prenom' => 'ROUKARIATOU', 'email' => 'k3578255@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '53248340'],
            ['nom' => 'OUEDRAOGO', 'prenom' => 'KASSIROU', 'email' => 'Kassirou70@icloud.com', 'structure' => 'ELITE IT', 'telephone' => '56854539'],
            ['nom' => 'GAMENE', 'prenom' => 'SIDBEWENDE GAIUS', 'email' => 'gamenegaiussou@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '56865618'],
            ['nom' => 'KINDA', 'prenom' => 'NORBERT', 'email' => 'kindanorbert336@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '75243469'],
            ['nom' => 'SANDWIDI', 'prenom' => 'SAHAOUDA', 'email' => 'sandwidisahaouda@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '66722689'],
            ['nom' => 'BOUSSIM', 'prenom' => 'LASSANA', 'email' => 'lassanaboussim625@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '64471118'],
            ['nom' => 'KABORE', 'prenom' => 'SANDRINE', 'email' => 'kaboresandrine429@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '64723028'],
            ['nom' => 'SAWADOGO', 'prenom' => 'MOUSSA', 'email' => 'Sawadogomoussa20@yahoo.fr', 'structure' => 'ELITE IT', 'telephone' => '77073786'],
            ['nom' => 'BOMBIRI', 'prenom' => 'CHRISTIAN ARMEL DESIRE', 'email' => 'christianbombiri@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '57281033'],
            ['nom' => 'CISSE', 'prenom' => 'ALASSANE', 'email' => 'cisse@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'YAMEOGO', 'prenom' => 'WENDYIDA JEAN ELISE', 'email' => 'yameogo@elite-it.com', 'structure' => 'ELITE IT', 'telephone' => null],
            ['nom' => 'ILBOUDO', 'prenom' => 'ALASSANE', 'email' => 'alassanee.ilboudo@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '78910477'],
            ['nom' => 'TAPSOBA', 'prenom' => 'NATEWENDE JOSEPH', 'email' => 'josephtapsoba555@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '55551483'],
            ['nom' => 'TAPSOBA', 'prenom' => 'ABDOUL-GANIHOU RAZACK', 'email' => 'razacktapsoba2881@gmail.com', 'structure' => 'ELITE IT', 'telephone' => '70314894'],
        ];

        foreach ($agents as $data) {
            Agent::firstOrCreate(
                ['email' => $data['email']],
                [
                    'nom'          => $data['nom'],
                    'prenom'       => $data['prenom'],
                    'password'     => Hash::make('Elite@2024'),
                    'structure'    => $data['structure'],
                    'telephone'    => $data['telephone'],
                    'qr_code_uuid' => Str::uuid()->toString(),
                    'actif'        => true,
                ]
            );
        }
    }
}