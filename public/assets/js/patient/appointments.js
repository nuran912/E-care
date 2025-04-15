
                const tabs = document.querySelectorAll('.tab-button');
                const all_content = document.querySelectorAll('.content');

                tabs.forEach((tab,index) => {
                    tab.addEventListener('click',(e) => {
                        tabs.forEach(tab => {tab.classList.remove('active')});
                        tab.classList.add('active');

                        var line = document.querySelector('.line');
                        line.style.width = e.target.offsetWidth + "px";
                        line.style.left = e.target.offsetLeft + "px";

                        all_content.forEach(content => {content.classList.remove('active')});
                        all_content[index].classList.add('active');
                    });
                });

                document.querySelectorAll('.tab-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const section = this.textContent.includes('Pending') ? 'pending' : 'past';
                        const queryParams = new URLSearchParams(window.location.search);
                        queryParams.set('section', section); // Set the active section
                
                        if (section === 'pending') {
                            queryParams.set('page_pending', 1); // Reset pagination for Pending
                            queryParams.delete('page_past');   // Remove pagination for Past
                        } else if (section === 'past') {
                            queryParams.set('page_past', 1);   // Reset pagination for Past
                            queryParams.delete('page_pending'); // Remove pagination for Pending
                        }
                
                        window.location.search = queryParams.toString(); // Update the URL
                    });
                });


                