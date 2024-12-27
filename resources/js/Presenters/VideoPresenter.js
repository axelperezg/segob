export default class VideoPresenter {
    constructor(video) {
        this.video = video;
    }

    get id() {
        return this.video.id;
    }

    get title() {
        return this.video.title;
    }

    get url() {
        return this.video.url;
    }

    get isPublished() {
        return this.video.is_published;
    }

    get publishedAt() {
        return this.video.published_at;
    }

    get thumbnail() {
        return this.video.image;
    }
} 