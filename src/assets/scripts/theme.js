/**
 * Application Bootstrap
 *
 * @package     PointlessTheme - Nex
 * @author      Scar Wu
 * @copyright   Copyright (c) Scar Wu (http://scar.tw)
 * @link        https://github.com/scarwu/PointlessTheme-Nex
 */

import axios from 'axios'
import hljs from 'highlight.js'

/**
 * Default Functions
 */
const log = (...params) => {
    if ('production' !== process.env.NODE_ENV) {
        console.log.apply(this, params)
    }
}

const isEmpty = (variable) => {
    return (undefined === variable || null === variable)
}

const isNotEmpty = (variable) => {
    return (undefined !== variable && null !== variable)
}

const asyncLoad = (src) => {
    let s = document.createElement('script')

    s.src = src
    s.async = true

    let e = document.getElementsByTagName('script')[0]

    e.parentNode.insertBefore(s, e)
}

const resizeMedia = (node) => {
    const content = document.querySelector('.nx-container .nx-content')

    if (isEmpty(content)) {
        return
    }

    const contentWidth = content.offsetWidth < 960 ? content.offsetWidth : 960

    if (isEmpty(node.offsetWidth)
        || isEmpty(node.offsetHeight)
        || 0 === node.offsetWidth
        || 0 === node.offsetHeight
    ) {
        return
    }

    if ('img' === node.tagName.toLowerCase()) {
        node.style.height = 'inherit'
        node.style.width = 'inherit'
    }

    if (node.offsetWidth < node.offsetHeight) {
        node.style.maxHeight = contentWidth + 'px'

        if ('video' === node.tagName.toLowerCase()
            && isNotEmpty(node.width)
            && isNotEmpty(node.height)
        ) {
            node.style.maxWidth = ((contentWidth * node.width) / node.height) + 'px'
        }
    } else if (node.offsetWidth >= node.offsetHeight) {
        node.style.maxWidth = contentWidth + 'px'

        if ('video' === node.tagName.toLowerCase()
            && isNotEmpty(node.width)
            && isNotEmpty(node.height)
        ) {
            node.style.maxHeight = ((contentWidth * node.height) / node.width) + 'px'
        }
    }
}

const replaceElements = () => {
    document.querySelectorAll('.nx-container .nx-content a').forEach((node) => {
        node.target = '_blank'
    })

    document.querySelectorAll('.nx-container .nx-content pre code').forEach((node) => {
        hljs.highlightElement(node)
    })

    document.querySelectorAll('.nx-container .nx-content table').forEach((node) => {
        console.log(node)
        let tablBlock = document.createElement('div')

        tablBlock.classList.add('nx-table-block');
        tablBlock.innerHTML = node.outerHTML

        node.replaceWith(tablBlock)
    })

    document.querySelectorAll('.nx-container .nx-content p img').forEach((node) => {
        node.loading = 'lazy'
        node.onload = () => {
            resizeMedia(node)
        }
    })

    document.querySelectorAll('.nx-container .nx-content p video').forEach((node) => {
        node.loading = 'lazy'
        node.onload = () => {
            resizeMedia(node)
        }
    })
}

const resizeElements = () => {
    document.querySelectorAll('.nx-container .nx-content p img').forEach((node) => {
        resizeMedia(node)
    })

    document.querySelectorAll('.nx-container .nx-content p video').forEach((node) => {
        resizeMedia(node)
    })
}

const refreshPageWithoutLoading = (newUrl, stateAction = null) => {
    let oldTitle = document.title
    let oldContainer = document.querySelector('.nx-container').innerHTML

    // Enable Loading Progress
    document.querySelector('#nx-loading').style.display = 'block'
    document.querySelector('#nx-loading .nx-progress').style.width = '0%'

    axios.get(newUrl, {
        onDownloadProgress: (event) => {
            document.querySelector('#nx-loading .nx-progress').style.width = Math.round((event.loaded * 100) / event.total) + '%'
        }
    }).then((res) => {
        let newDoc = (new DOMParser()).parseFromString(res.data, 'text/html')
        let newTitle = newDoc.title
        let newContainer = newDoc.querySelector('.nx-container').innerHTML

        // Replace Document Element(s)
        document.title = newTitle
        document.querySelector('.nx-container').innerHTML = newContainer

        // Set History State
        switch (stateAction) {
        case 'push':
            window.history.pushState({
                url: newUrl,
                title: newTitle
            }, newTitle, newUrl)

            break
        case 'replace':
            window.history.replaceState({
                url: newUrl,
                title: newTitle
            }, newTitle, newUrl)

            break
        }

        // GA & Disqus
        if (isNotEmpty(window._nx.googleAnalytics)) {
            gtag('send', 'page_view', {
                page_location: window.location.href
            })
        }
    }).catch((error) => {
        log(error)

        // Replace Document Element(s)
        document.title = oldTitle
        document.querySelector('.nx-container').innerHTML = oldContainer
    }).finally(() => {

        // Disable Loading Progress
        document.querySelector('#nx-loading').style.display = 'none'
        document.querySelector('#nx-loading .nx-progress').style.width = '0%'

        // Replace Elements
        replaceElements()

        // Resize Elements
        resizeElements()

        // Disqus
        if (isNotEmpty(window._nx.disqusShortname)
            && document.getElementById('disqus_thread')
        ) {
            if (isEmpty(window.DISQUS)) {
                asyncLoad('//' + window._nx.disqusShortname + '.disqus.com/embed.js')
            } else {
                window.DISQUS.reset({
                    reload: true
                })
            }
        }

        if (null !== stateAction) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        }
    })
}

/**
 * Listener
 */
window.addEventListener('load', () => {

    // GA & Disqus
    if (isNotEmpty(window._nx.googleAnalytics)) {
        asyncLoad('https://www.googletagmanager.com/gtag/js?id=' +  window._nx.googleAnalytics)

        window.dataLayer = window.dataLayer || []
        window.gtag = function () {
            dataLayer.push(arguments)
        }

        gtag('js', new Date())
        gtag('config', window._nx.googleAnalytics)
    }

    if (isNotEmpty(window._nx.disqusShortname)
        && document.getElementById('disqus_thread')
    ) {
        asyncLoad('//' + window._nx.disqusShortname + '.disqus.com/embed.js')
    }

    // Init History State
    let url = window.location.pathname
    let title = document.title

    window.history.pushState({
        url: url,
        title: title
    }, title, url)

    // Replace Elements
    replaceElements()

    // Resize Elements
    resizeElements()
})

window.addEventListener('resize', () => {

    // Resize Elements
    resizeElements()
})

// No Page Refresh SSR
window.addEventListener('click', (event) => {
    if ('a' !== event.target.tagName.toLowerCase()
        || '_blank' === event.target.target
    ) {
        return
    }

    event.preventDefault()

    refreshPageWithoutLoading(event.target.href, 'push')
})

window.addEventListener('popstate', (event) => {
    refreshPageWithoutLoading(event.state.url)
})

// Page Control Hotkeys
window.addEventListener('keydown', (event) => {
    switch(event.keyCode) {
    case 37:
    case 72:
        let prev = document.querySelector('.nx-paginator .nx-prev a')

        if (isNotEmpty(prev)) {
            prev.click()
        }

        break
    case 39:
    case 76:
        let next = document.querySelector('.nx-paginator .nx-next a')

        if (isNotEmpty(next)) {
            next.click()
        }

        break
    case 74:
        window.scrollBy(0, 40)

        break
    case 75:
        window.scrollBy(0, -40)

        break
    }
})
