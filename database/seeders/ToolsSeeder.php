<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tools;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tools = [
            [
                'name_tools' => 'Visual Studio Code',
                'link' => 'https://code.visualstudio.com/download',
                'logo_tools' => 'https://code.visualstudio.com/assets/images/code-stable.png'
            ],
            [
                'name_tools' => 'Mysql',
                'link' => 'https://www.mysql.com/downloads',
                'logo_tools' => 'https://www.mysql.com/common/logos/mysql-logo.svg'
            ],
            [
                'name_tools' => 'Figma',
                'link' => 'https://www.figma.com/downloads',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/3/33/Figma-logo.svg'
            ],
            [
                'name_tools' => 'GitHub',
                'link' => 'https://github.com',
                'logo_tools' => 'https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png'
            ],
            [
                'name_tools' => 'Docker',
                'link' => 'https://www.docker.com/get-started/',
                'logo_tools' => 'https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png'
            ],
            [
                'name_tools' => 'Sublime Text',
                'link' => 'https://www.sublimetext.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/d/d2/Sublime_Text_3_logo.png'
            ],
            [
                'name_tools' => 'IntelliJ IDEA',
                'link' => 'https://www.jetbrains.com/idea/download/',
                'logo_tools' => 'https://resources.jetbrains.com/storage/products/company/brand/logos/IntelliJ_IDEA_icon.svg'
            ],
            [
                'name_tools' => 'PyCharm',
                'link' => 'https://www.jetbrains.com/pycharm/download/',
                'logo_tools' => 'https://resources.jetbrains.com/storage/products/pycharm/img/meta/pycharm_logo_300x300.png'
            ],
            [
                'name_tools' => 'Eclipse',
                'link' => 'https://www.eclipse.org/downloads/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Eclipse-Luna-Logo.svg'
            ],
            [
                'name_tools' => 'Notepad++',
                'link' => 'https://notepad-plus-plus.org/downloads/',
                'logo_tools' => 'https://notepad-plus-plus.org/images/logo.svg'
            ],
            [
                'name_tools' => 'Slack',
                'link' => 'https://slack.com/downloads',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/d/d5/Slack_icon_2019.svg'
            ],
            [
                'name_tools' => 'Zoom',
                'link' => 'https://zoom.us/download',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Zoom_Communications_Logo.svg'
            ],
            [
                'name_tools' => 'Google Drive',
                'link' => 'https://www.google.com/drive/download/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/d/da/Google_Drive_logo.png'
            ],
            [
                'name_tools' => 'Git',
                'link' => 'https://git-scm.com/downloads',
                'logo_tools' => 'https://git-scm.com/images/logos/downloads/Git-Icon-1788C.svg'
            ],
            [
                'name_tools' => 'Node.js',
                'link' => 'https://nodejs.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/d/d9/Node.js_logo.svg'
            ],
            [
                'name_tools' => 'Python',
                'link' => 'https://www.python.org/downloads/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/c3/Python-logo-notext.svg'
            ],
            [
                'name_tools' => 'PHP',
                'link' => 'https://www.php.net/downloads',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg'
            ],
            [
                'name_tools' => 'Ruby',
                'link' => 'https://www.ruby-lang.org/en/downloads/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/73/Ruby_logo.svg'
            ],
            [
                'name_tools' => 'Java',
                'link' => 'https://www.java.com/en/download/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/3/30/Java_programming_language_logo.svg'
            ],
            [
                'name_tools' => 'Go',
                'link' => 'https://golang.org/dl/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/0/05/Go_Logo_Blue.svg'
            ],
            [
                'name_tools' => 'Flutter',
                'link' => 'https://flutter.dev/docs/get-started/install',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/1/17/Google-flutter-logo.png'
            ],
            [
                'name_tools' => 'Angular',
                'link' => 'https://angular.io/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/cf/Angular_full_color_logo.svg'
            ],
            [
                'name_tools' => 'Laravel',
                'link' => 'https://laravel.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg'
            ],
            [
                'name_tools' => 'Django',
                'link' => 'https://www.djangoproject.com/download/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/75/Django_logo.svg'
            ],
            [
                'name_tools' => 'Bootstrap',
                'link' => 'https://getbootstrap.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/b/b2/Bootstrap_logo.svg'
            ],
            [
                'name_tools' => 'Tailwind CSS',
                'link' => 'https://tailwindcss.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg'
            ],
            [
                'name_tools' => 'Sass',
                'link' => 'https://sass-lang.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/9/96/Sass_Logo_Color.svg'
            ],
            [
                'name_tools' => 'Gulp',
                'link' => 'https://gulpjs.com/',
                'logo_tools' => 'https://gulpjs.com/img/gulp-white-text.svg'
            ],
            [
                'name_tools' => 'Vite',
                'link' => 'https://vitejs.dev/',
                'logo_tools' => 'https://vitejs.dev/logo.svg'
            ],
            [
                'name_tools' => 'React',
                'link' => 'https://reactjs.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg'
            ],
            [
                'name_tools' => 'Svelte',
                'link' => 'https://svelte.dev/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/1/1b/Svelte_Logo.svg'
            ],
            [
                'name_tools' => 'Next.js',
                'link' => 'https://nextjs.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/8/8e/Nextjs-logo.svg'
            ],
            [
                'name_tools' => 'jQuery',
                'link' => 'https://jquery.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/9/9e/JQuery_logo.svg'
            ],
            [
                'name_tools' => 'Material-UI (MUI)',
                'link' => 'https://mui.com/',
                'logo_tools' => 'https://mui.com/static/logo.png'
            ],
            [
                'name_tools' => 'Redux',
                'link' => 'https://redux.js.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/4/49/Redux.png'
            ],
            [
                'name_tools' => 'GraphQL',
                'link' => 'https://graphql.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/1/17/GraphQL_Logo.svg'
            ],
            [
                'name_tools' => 'Prettier',
                'link' => 'https://prettier.io/',
                'logo_tools' => 'https://prettier.io/icon.png'
            ],
            [
                'name_tools' => 'Astro',
                'link' => 'https://astro.build/',
                'logo_tools' => 'https://astro.build/assets/press/astro-logo-light.svg'
            ],
            [
                'name_tools' => 'WordPress',
                'link' => 'https://wordpress.org/download/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/2/20/WordPress_logo.svg'
            ],
            [
                'name_tools' => 'Adobe XD',
                'link' => 'https://www.adobe.com/products/xd.html',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/c2/Adobe_XD_CC_icon.svg'
            ],
            [
                'name_tools' => 'Firebase',
                'link' => 'https://firebase.google.com/',
                'logo_tools' => 'https://firebase.google.com/images/social.png'
            ],
            [
                'name_tools' => 'Netlify',
                'link' => 'https://www.netlify.com/',
                'logo_tools' => 'https://www.netlify.com/v3/img/components/logomark.png'
            ],
            [
                'name_tools' => 'DigitalOcean',
                'link' => 'https://www.digitalocean.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/f/ff/DigitalOcean_logo.svg'
            ],
            [
                'name_tools' => 'Redis',
                'link' => 'https://redis.io/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/6/6b/Redis_Logo.svg'
            ],
        ];

        for ($i = 0; $i < count($Tools); $i++) {
            Tools::create($Tools[$i]);
        }
    }
}