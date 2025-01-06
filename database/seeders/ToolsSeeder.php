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
                'name_tools' => 'Postman',
                'link' => 'https://www.postman.com/downloads/',
                'logo_tools' => 'https://www.postman.com/_ar-assets/images/postman-logo-horizontal-orange.svg'
            ],
            [
                'name_tools' => 'Docker',
                'link' => 'https://www.docker.com/get-started/',
                'logo_tools' => 'https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png'
            ],
            [
                'name_tools' => 'XAMPP',
                'link' => 'https://www.apachefriends.org/download.html',
                'logo_tools' => 'https://www.apachefriends.org/images/xampp-logo.svg'
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
                'name_tools' => 'NetBeans',
                'link' => 'https://netbeans.apache.org/download/index.html',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/c9/Apache_NetBeans_Logo.svg'
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
                'name_tools' => 'Trello',
                'link' => 'https://trello.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/5/50/Trello-logo-blue.png'
            ],
            [
                'name_tools' => 'Jira',
                'link' => 'https://www.atlassian.com/software/jira/download',
                'logo_tools' => 'https://wac-cdn.atlassian.com/dam/jcr:b4862298-c991-450b-9789-d4c6c6e36a0c/jira-icon-gradient-blue.svg'
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
                'name_tools' => 'Dropbox',
                'link' => 'https://www.dropbox.com/install',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Dropbox_Icon.svg'
            ],
            [
                'name_tools' => 'Miro',
                'link' => 'https://miro.com/download/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/e/e6/Miro_Logo.svg'
            ],
            [
                'name_tools' => 'Canva',
                'link' => 'https://www.canva.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/6/62/Canva_logo.svg'
            ],
            [
                'name_tools' => 'Tableau',
                'link' => 'https://www.tableau.com/products/desktop/download',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Tableau_Logo.png'
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
                'name_tools' => 'Kotlin',
                'link' => 'https://kotlinlang.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Kotlin-logo.svg'
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
                'name_tools' => 'React',
                'link' => 'https://reactjs.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg'
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
                'name_tools' => 'Webpack',
                'link' => 'https://webpack.js.org/',
                'logo_tools' => 'https://webpack.js.org/icon-pwa-512x512.d3dae4189855b3a72ff9.png'
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
                'name_tools' => 'Vue.js',
                'link' => 'https://vuejs.org/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/9/95/Vue.js_Logo_2.svg'
            ],
            [
                'name_tools' => 'Angular',
                'link' => 'https://angular.io/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/cf/Angular_full_color_logo.svg'
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
                'name_tools' => 'Nuxt.js',
                'link' => 'https://nuxt.com/',
                'logo_tools' => 'https://nuxt.com/assets/design-kit/logo/icon-green.svg'
            ],
            [
                'name_tools' => 'jQuery',
                'link' => 'https://jquery.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/9/9e/JQuery_logo.svg'
            ],
            [
                'name_tools' => 'Preact',
                'link' => 'https://preactjs.com/',
                'logo_tools' => 'https://preactjs.com/assets/logo-3967e27d.svg'
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
                'name_tools' => 'Apollo',
                'link' => 'https://www.apollographql.com/',
                'logo_tools' => 'https://www.apollographql.com/apollo-home/assets/logos/logo.png'
            ],
            [
                'name_tools' => 'Storybook',
                'link' => 'https://storybook.js.org/',
                'logo_tools' => 'https://repository-images.githubusercontent.com/199723670/2a4dc180-bafc-11e9-909f-c3b143b82716'
            ],
            [
                'name_tools' => 'ESLint',
                'link' => 'https://eslint.org/',
                'logo_tools' => 'https://eslint.org/assets/img/logo.svg'
            ],
            [
                'name_tools' => 'Prettier',
                'link' => 'https://prettier.io/',
                'logo_tools' => 'https://prettier.io/icon.png'
            ],
            [
                'name_tools' => 'Hugo',
                'link' => 'https://gohugo.io/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/3/32/Hugo-logo-A.png'
            ],
            [
                'name_tools' => 'Jekyll',
                'link' => 'https://jekyllrb.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/7/72/Jekyll_logo_by_Stefan_Johnson.png'
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
                'name_tools' => 'Webflow',
                'link' => 'https://webflow.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Webflow_logo.svg'
            ],
            [
                'name_tools' => 'Adobe XD',
                'link' => 'https://www.adobe.com/products/xd.html',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/c/c2/Adobe_XD_CC_icon.svg'
            ],
            [
                'name_tools' => 'InVision',
                'link' => 'https://www.invisionapp.com/',
                'logo_tools' => 'https://www.invisionapp.com/logo/invision-logo.svg'
            ],
            [
                'name_tools' => 'Zeplin',
                'link' => 'https://zeplin.io/',
                'logo_tools' => 'https://static.zeplin.io/zeplin-favicon.png'
            ],
            [
                'name_tools' => 'Sketch',
                'link' => 'https://www.sketch.com/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/8/8e/Sketch_Logo.svg'
            ],
            [
                'name_tools' => 'WAMP',
                'link' => 'http://www.wampserver.com/en/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/a/ac/WampServer-logo.png'
            ],
            [
                'name_tools' => 'Firebase',
                'link' => 'https://firebase.google.com/',
                'logo_tools' => 'https://firebase.google.com/images/social.png'
            ],
            [
                'name_tools' => 'Supabase',
                'link' => 'https://supabase.com/',
                'logo_tools' => 'https://supabase.com/icons/icon-512x512.png'
            ],
            [
                'name_tools' => 'Heroku',
                'link' => 'https://www.heroku.com/',
                'logo_tools' => 'https://brand.heroku.com/static/media/heroku-logotype.c7343db1.svg'
            ],
            [
                'name_tools' => 'Vercel',
                'link' => 'https://vercel.com/',
                'logo_tools' => 'https://assets.vercel.com/image/upload/v1607554385/front/vercel/dps/logo.png'
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
                'name_tools' => 'MongoDB',
                'link' => 'https://www.mongodb.com/try/download/community',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/4/45/MongoDB-Logo.svg'
            ],
            [
                'name_tools' => 'Redis',
                'link' => 'https://redis.io/',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/en/6/6b/Redis_Logo.svg'
            ],
            [
                'name_tools' => 'ElasticSearch',
                'link' => 'https://www.elastic.co/downloads/elasticsearch',
                'logo_tools' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Elastic.co_logo.svg'
            ]
        ];

        for ($i = 0; $i < count($Tools); $i++) {
            Tools::create($Tools[$i]);
        }
    }
}