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
        return `Publicado el ${day} de ${month} de ${year}`;
    }

    get isPublished() {
        return this.post.is_published;
    }

    get contentType() {
        return this.post.content_type;
    }

    get state() {
        return this.post.state;
    }

    get keywords() {
        return this.post.keywords;
    }

    get createdBy() {
        return this.post.created_by;
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
}
