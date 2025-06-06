import dayjs from 'dayjs'

export default class VideoPresenter {
    constructor(video) {
        this.video = video
    }

    get id() {
        return this.video.id
    }

    get title() {
        return this.video.title
    }

    get url() {
        return this.video.url
    }

    get is_published() {
        return this.video.is_published
    }

    get published_at() {
        const months = [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre',
        ]
        const date = dayjs(this.video.published_at)
        const day = date.date().toString().padStart(2, '0')
        const month = months[date.month()]
        const year = date.year()
        return `${day} de ${month} de ${year}`
    }

    get image() {
        return this.video.image
    }
}
