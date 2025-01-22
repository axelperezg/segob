import dayjs from "dayjs";

export default class PostPresenter {
    constructor(post) {
        this.post = post;
    }

    get title() {
        return this.post.title;
    }

    get content() {
        return this.post.content;
    }

    get slug() {
        return this.post.slug;
    }

    get publishedAt() {
        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        const date = dayjs(this.post.published_at);
        const day = date.date();
        const month = months[date.month()];
        const year = date.year();
        return `${day} de ${month} de ${year}`;
    }

    get formattedDate() {
        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        const date = dayjs(this.post.published_at);
        const day = date.date().toString().padStart(2, '0');
        const month = months[date.month()];
        const year = date.year();
        return `${day} de ${month} de ${year}`;
    }

    get isPublished() {
        return this.post.is_published;
    }

    get contentType() {
        return this.post.content_type;
    }

    get states() {
        return this.post.states;
    }

    get keywords() {
        return this.post.keywords;
    }

    get bulletin() {
        return this.post.bulletin;
    }

    get year() {
        return this.post.year;
    }

    get createdBy() {
        return this.post.createdBy?.name;
    }

    get featuredImage() {
        return this.post.featured_image;
    }

    get actions() {
        return this.post.actions;
    }

    get dependencies() {
        return this.post.dependencies;
    }

    get documents() {
        return this.post.documents;
    }

    get hasPhotos() {
        return this.post.photo_gallery_id;
    }

    get hasAudio() {
        return this.post.audio_id;
    }

    get hasDocument() {
        return this.post.document_id;
    }

    get hasVideo() {
        return this.post.video_id;
    }
}
