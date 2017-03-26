/**
 * Object for work with modal.
 */
var modal = {
    /**
     * Show/hide.
     */
    toggle: function () {
        $('#shot-modal').modal('toggle');
    },
    /**
     * Check modal is open
     * @return bool [0,1]
     */
    isOpen: function () {
        return $('#shot-modal').hasClass('in');
    },
    /*
     * Open modal only if this closed
     */
    toggleIfNotOpen: function () {
        if (!modal.isOpen()) {
            modal.toggle();
        }
    }
}

function Title() {
    this.appName = "TheShots - ";

    this.dom = document.getElementById('title');

    this.previous = null;

    this.store = function () {
        this.previous = this.dom.text;
    }

    /**
     * Change the current title name.
     * if $compact is true, we just add the key we are to the title, else make new title.
     * @param name
     * @param compact
     * @returns {*}
     */
    this.change = function (name, compact = false) {
        if (compact) {
            return this.dom.text += name;
        }

        return this.dom.text = this.appName + name;
    }

    this.setPrevious = function () {
        this.dom.text = this.previous;
    }
}

var _title = new Title;

/**
 * Обьект для более удобной работы с URL.
 * Зависим от url.min.js
 */
var _get = {
    previous: null,

    /**
     * Устанавливает нужному нам гет параметру нужное нам значение.
     * Если replace не совпадает ни с одним значением из allowed, вернется первое значение allowed.
     *
     * @param name
     * @param replace
     * @param allowed
     * @returns {*}
     */
    setGetParameter: function (name, replace, allowed) {
        if (allowed.indexOf(replace) > -1) {
            Url.updateSearchParam(name, replace, true);
        } else {
            return allowed[0];
        }

        return replace;
    },
    /**
     * Берем нужное нам $_GET значение.
     * Если значение name не совпадает ни с одним из allowed
     * Вернется первое значение массива allowed.
     * @param name
     * @param allowed
     * @returns {*}
     */
    getEvenIfNotExist: function (name, allowed) {
        var get = Url.queryString(name);

        if (get) {
            if (allowed.indexOf(get) > -1) {

                _title.change(get, true);

                return get;
            }
        }
        Url.updateSearchParam(name, allowed[0], true);

        _title.change(allowed[0], true);

        return allowed[0];
    },
    /**
     * Store the current $url to the previous variable inside _get.
     */
    storeCurrentUrl: function ($url) {
        _get.previous = $url;
        console.log('Previous url was saved.');
    },

    /**
     * Формирует предыдущее действие пользователя.
     * @param action
     * @param action_id
     * @param action_data
     * @returns {string}
     */
    getPreviousUrl: function (action, action_id, action_data = null) {
        var back = "/login?back=" + Url.getLocation().substr(1);
        var action = "&action=" + action;
        var action_id = "&action_id=" + action_id;

        var url = back + action + action_id;

        return action_data ? url + '&action_data=' + action_data : url;
    }
}

/**
 * Toggle like.
 * I very bad js player, sorry!
 */
function like(e, likes_count) {
    if (e.find('.fa').hasClass('fa')) {
        e.find('span').text(likes_count);

        e.find('.fa').toggleClass('fa-heart-o fa-heart');
    } else {
        e.text(likes_count);

        e.toggleClass('liked');
    }
}

/**
 * @desc simple angular paginator.
 * @author https://goo.gl/yX02G0
 */
function Paginator(items) {
    this.current_page = 0;

    this.per_page = 5;

    this.items = items;

    this.first_page = function () {
        return this.current_page == 0;
    }

    this.last_page = function () {
        var lastPageNum = Math.ceil(this.items.length / this.per_page - 1);
        return this.current_page == lastPageNum;
    }

    this.get_last_page = function () {
        return Math.ceil(this.items.length / this.per_page - 1);
    }

    this.number_of_pages = function () {
        return Math.ceil(this.items.length / this.per_page);
    }

    this.starting_item = function () {
        return this.current_page * this.per_page;
    }

    this.page_back = function () {
        this.current_page = this.current_page - 1;
        this.updateUrl();
    }

    this.page_forward = function () {
        this.current_page = this.current_page + 1;
        this.updateUrl();
    }

    this.has_items = function () {
        return this.items.length > 0;
    }

    this.updateUrl = function () {
        if (this.current_page) {
            Url.updateSearchParam('page', this.current_page + 1);
        } else {
            Url.updateSearchParam('page');
        }
    }
}

// new test container.
function Container($section = 'act', $states = []) {
    var self = this;

    this.page = 1;

    this.items = [];

    this.spinner = false;

    this.spinner_more = false;

    this.sign_in_to_continue = false;

    /**
     * Create a cache slots for current allowed $states in url.
     */
    this.createItemSlots = function ()
    {
        $states.forEach(function (item, index) {
            self.items[item] = {page: 1};
        });
    }

    /**
     * Обновляет текущие шоты, если $loadMore = true.
     * Так же устанавливает страницу на 1.
     */
    this.initialize = function ($loadMore) {
        let items = this.items[Url.queryString($section)];

        if (!$loadMore) {
            items.items = [];
            items.page = 1;
            this.spinner = true;
        } else {
            items.page++;
            this.spinner_more = true;
        }
    }

    /**
     * @param object
     * @param loadMore
     */
    this.convert = function (object, loadMore) {
        var items = this.items[Url.queryString($section)];

        if (loadMore) {
            this.spinner_more = false;

            /**
             * Concat not working. o__o
             */
            object.data.forEach(function (e) {
               items.items.push(e);
            });
        } else {
            this.spinner = false;
            items.last_page = object.last_page;
            items.items = object.data;
        }
        this.get().sign_in_to_continue = this.get().page > 2 && !auth.check ? true : false;
    }

    /**
     * Get current items cache container.
     * @returns {*}
     */
    this.get = function (act = false)
    {
        if(! act)
            act = Url.queryString($section);

        return this.items[act];
    }

    /**
     * 
     * @param id
     * @param likes_count
     */
    this.like = function (id, likes_count)
    {
        this.get().items.forEach(function (e) {
           if(e.id == id) {
               let liked = e.liked ? false : true;
               e.liked = liked;
               e.likes_count = likes_count;
               self.likeOthers(e);
           }
        });
    };

    /**
     * Поскольку мы сохраняем данные в Js
     * при переходе на другую "секцию" (лайки,шоты) информация о лайкнутых шотах не обновляется
     * поэтому мы обновляем ее тут.
     *
     * @param item | this.items[section].items[item]
     */
    this.likeOthers = function (item)
    {
        for(var index in this.items) {
            let items = this.items[index].items;

            if(typeof items != 'undefined') {
                items.map(function (e) {
                    if(e.id == item.id) {
                        e.liked = item.liked;
                        e.likes_count = item.likes_count;
                    }
                });
            }
        }
    };

    this.follow = function (user_id, followers_count)
    {
        this.get().items.forEach(function (e) {
            if(e.id == user_id) {
                e.is_follow = e.is_follow ? false : true;
                e.links.followers.count = followers_count;

                self.followOthers(e);
            }
        });
    }

    this.followOthers = function (item)
    {
        for(var index in this.items) {
            let items = this.items[index].items;

            if(typeof items != 'undefined') {
                items.map(function (e) {
                    if(e.id == item.id) {
                        e.is_follow = item.is_follow;
                        e.links.followers.count = item.links.followers.count;
                    }
                });
            }
        }
    };

    this.hasItems = function ()
    {
        return this.get().items.length;
    }

    this.createItemSlots();
}

/**
 * Simply storage for items.
 */
function Box ()
{
    this.items = [];

    /**
     * Find a current object
     *
     * @param id
     * @param key
     * @returns {*}
     */
    this.find = function (id, key = 'id') {
        var el = this.items.filter(function (e) {
            if (e[key] == id) {
                return e;
            }
        });

        if (typeof el[0] !== 'undefined') {
            return el[0];
        }
        return null;
    }

    this.store = function (object)
    {
        if(!this.find(object.id)) {
            this.items.push(object);
        }
    }
}

var _Api = function ()
{
    this.method = function (name, page = 1)
    {
        this.url = '/api/' + name + '?page=' + page;
        return this;
    }

    this.get = function (page = 1)
    {
        return this.url + '.get' + '?page=' + page;
    }

    this.add = function ()
    {
        return this.url + '.add';
    }
    
    this.bySection = function (section, page = 1)
    {
        let method = null;

        switch (section)
        {
            case 'shots':
                method = 'users.shots';
            break;

            case 'likes':
                method = 'users.likes';
            break;

            case 'followers':
                method = 'users.followers';
            break;

            case 'followings':
                if(_route == 'shots') {
                    method = 'shots.followings';
                }else {
                    method = 'users.followings';
                }
            break;

            case 'recent':
                method = 'shots.recent';
            break;

            case 'popular':
                method = 'shots.popular';
            break;

            case 'gaining':
                method = 'shots.gaining';
            break;

            case 'shot':
                method = 'shots.get';
            break;

            default:
                method = 'shots.recent';
            break;
        }

        return '/api/' + method + '?page=' + page;
    }
}

var api = new _Api;

var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();