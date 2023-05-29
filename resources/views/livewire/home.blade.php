<div class="p-8 flex flex-col items-center">
    <style>
        body {
            height: 100vh;
            width: 100vw;
        }

        .neon {
            color: #0f0;
            text-shadow:
            0 0 7px rgb(47, 46, 46),
            0 0 10px rgb(47, 46, 46),
            0 0 21px rgb(47, 46, 46),
            0 0 42px #0f0,
            0 0 82px #0f0,
            0 0 92px #0f0,
            0 0 102px #0f0,
            0 0 10px #0f0;
        }

        .blinking {
            animation: blink-animation 2s steps(5, start) infinite;
            -webkit-animation: blink-animation 2s steps(5, start) infinite;
            user-select: none
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        @-webkit-keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        #typewriter {
            overflow: hidden;
            white-space: nowrap;
            margin: 0 auto;
            border-right: .03em solid #0f0;
            animation: 
                typing 1.5s steps(70, end),
                blink-caret 1.6s step-end 3 normal forwards;
            user-select: none;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 22% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #0f0 }
            100% { border-right: none }
        }
    </style>

    <div id="header" class="antialiased rounded-lg h-48 max-sm:w-full max-md:w-full w-2/3 p-4 flex flex-col justify-center bg-slate-800 shadow-lg">
        <h2 id="typewriter" class="text-4xl text-white"><span class="blinking neon" style="">></span> FeijóHub</h2>
    
        <div class="search mt-10 flex flex-col justify-center w-full">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Nome do repositório ou autor" required>
            </div>
        </div>
    </div>

    <div id="posts" class="w-full flex flex-col items-center justify-center"> 

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>

        const repositories = JSON.parse('{!! json_encode($projects) !!}')

        for(const repository in repositories) {
            const repositoriesIds = repositories[repository]

            $.get(`https://api.github.com/users/${repository}/repos`, function (data) {
                const filteredRepositories = data.filter(repository => repositoriesIds.includes(repository.id.toString()))

                for(const repository of filteredRepositories) {
                    appendRepository(repository.name, repository.stargazers_count, repository.owner.login, repository.description)
                }
            });
        }

        $( "#default-search" ).on("input", function() {
            
            const inputValue = $('#default-search').val()
  
            if(!inputValue) {
                $('.post').each(function () {
                    this.style.display = 'block'
                })

                console.log('aaa')
            }
            
            const value = search(inputValue)
        });

        const search = (text) => {
            text = text.toLowerCase().trim()

            const repoNames = $('.repo-name')

            for(let name of repoNames) {
                if(!(name.innerText.toLowerCase().indexOf(text) > -1)) {
                    name.parentElement.parentElement.style.display = 'none'
                }
            }
        }

        const appendRepository = (name, stars, owner, description) => {
            $('#posts').append(`
                <div class="post bg-slate-800 shadow-lg p-4 rounded-lg mt-6 flex flex-col max-sm:w-full max-md:w-full w-2/3">
                    <div class="header flex justify-between items-center w-full">
                        <h2 class="repo-name neon text-lg"><a href="https://github.com/${owner}/${name}" target="_blank">${name}</a></h2>

                        <h2 class="owner-name text-white text-md">👤 Criado por ${owner}</h2>
                    </div>

                    <div class="stars flex items-center justify-between text-white text-base">
                        <h2>⭐ ${stars} stars</h2>
                        
                    </div>

                    <div class="description mt-4 text-center text-gray-100 antialiased">
                        ${description || 'Nenhuma descrição inserida.'}
                    </div>

                </div>
            `)
        }

    </script>
</div>
