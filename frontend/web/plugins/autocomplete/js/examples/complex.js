window.addEventListener('DOMContentLoaded', () => {

  /**
   * COMPLEX EXAMPLE
   */

  const auto = new Autocomplete('project-search-name', {
    // search delay
    delay: 1000,

    // add button 'x' to clear the text from
    // the input filed
    clearButton: false,

    // default selects the first item in
    // the list of results
    selectFirst: true,

    // add text to the input field as you move through
    // the results with the up/down cursors
    insertToInput: true,

    // the number of characters entered
    // should start searching
    howManyCharacters: 1,

    // enter the name of the class by
    // which you will name the group element
    classGroup: 'group-by',

    // Function for user input. It can be a synchronous function or a promise
    // you can fetch data with jquery, axios, fetch, etc.
    onSearch: ({ currentValue }) => {
      // static file
      // const api = './characters.json';

      // OR -------------------------------

      // your REST API
      //const api = `https://breakingbadapi.com/api/characters?name=${encodeURI(currentValue)}`;
      
      const api =`https://e-land.vn/api/index.php/projects/search?fields=name,id,status,investor&expand=images&name=${encodeURI(currentValue)}`;
      /**
        * jquery
        * If you want to use jquery you have to add the
        * jquery library to head html
        * https://cdnjs.com/libraries/jquery
        */
      // return $.ajax({
      //   url: api,
      //   method: 'GET',
      // })
      //   .done(function (data) {
      //     return data
      //   })
      //   .fail(function (xhr) {
      //     console.error(xhr);
      //   });

      // OR ----------------------------------

      /**
        * axios
        * If you want to use axios you have to add the
        * axios library to head html
        * https://cdnjs.com/libraries/axios
        */
      // return axios.get(api)
      //   .then((response) => {
      //     return response.data;
      //   })
      //   .catch(error => {
      //     console.log(error);
      //   });

      // OR ----------------------------------

      /**
        * Promise
        */
      return new Promise((resolve) => {
        fetch(api)
          .then((response) => response.json())
          .then((data) => {
            resolve(data);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    },

    // this part is responsible for the number of records,
    // the appearance of li elements and it really depends
    // on you how it will look
    onResults: ({ currentValue, matches, template, classGroup }) => {
      document.getElementById("project-id").value;
      // const regex = new RegExp(^${input}`, 'gi'); // start with
      const regex = new RegExp(currentValue, 'gi');
      console.log(currentValue);
      console.log(matches);
      console.log(template);
      console.log(classGroup);
      // counting status elements
      function count(status) {
        let count = {};
        matches.map(el => {
          count[el.status] = (count[el.status] || 0) + 1;
        });
        return `<small>${count[status]} items</small>`;
      }

      // checking if we have results if we don't
      // take data from the noResults callback
      return matches === 0 ? template : matches
        .sort((a, b) => a.name.localeCompare(b.name))
        .map((el, index, array) => {
          console.log(el, index, array);
          // we create an element of the group
          let group = el.status !== array[index - 1]?.status
            ? `<li class="${classGroup}"><span>${el.status}</span> ${count(el.status)}</li>`
            : '';
        
          // this part is responsible for the appearance
          // in the drop-down list - see the example in index.html
          // remember only the first element from <li> is put
          // into the input field, in this case the text
          // from the <p> element
          return `
            ${group}
            <li>
              <div style="display: flex;">
                <div style="margin-right: 10px;">
                </div>
                <div class="info">
                  <div class="title"> ${el.name.replace(regex, (str) => `<b style="color: #009245;">${str}</b>`)}</div>
                   
                </div>
              </div>
            </li>`;
        }).join('');
    },

    // the onSubmit function is executed when the user
    // submits their result by either selecting a result
    // from the list, or pressing enter or mouse button
    onSubmit: ({ index, element, object, results }) => {
      console.log('complex: ', index, element, object, results);
      
      document.getElementById("project-id").value = object.id;
      // window.open(`https://www.imdb.com/find?q=${encodeURI(input)}`)
    },

    // get index and data from li element after
    // hovering over li with the mouse or using
    // arrow keys ↓ | ↑
    onSelectedItem: ({ index, element, object }) => {
      console.log('onSelectedItem:', index, element.value, object);
      document.getElementById("project-id").value = object.id;
    },

    // the callback presents no results
    noResults: ({ element, template }) => {
      template(`<li>No results found: "${element.value}"</li>`)
    }
  });

  // clear data
  /*
  const clearButton = document.querySelector('.clear-button');
  clearButton.addEventListener('click', () => {
    auto.destroy();
  })
*/
});