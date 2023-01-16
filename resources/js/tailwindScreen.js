
class TailwindScreen {
    constructor(){}

    isXs() {
        if (screen.width < 640) {
            return true;
        }

        return false;
    }

    isSm() {
        if (screen.width >= 640 && screen.width < 768) {
            return true;
        }

        return false;
    }

    isMd() {
        if (screen.width >= 768 && screen.width < 1024) {
            return true;
        }

        return false;
    }

    isLg() {
        if (screen.width >= 1024 && screen.width < 1280) {
            return true;
        }

        return false;
    }

    isXl() {
        if (screen.width >= 1280 && screen.width < 1536) {
            return true;
        }

        return false;
    }

    is2Xl() {
        if (screen.width >= 1536) {
            return true;
        }

        return false;
    }

    getScreen() {
        if(this.isXs()) {
            return 'xs';
        }
        
        if(this.isSm()) {
            return 'sm';
        }

        if(this.isMd()) {
            return 'md';
        }

        if(this.isLg()) {
            return 'lg';
        }

        if(this.isXl()) {
            return 'xl';
        }

        if(this.is2Xl()) {
            return '2xl';
        }
    }

    isDevice(device) {
        switch (device) {
            case 'phone':
                if(this.isXs() || this.isSm()) {
                    return true;
                }
                break;
            case 'tablet':
                if(this.isMd()) {
                    return true;
                }
                break;
            case 'pc':
                if(this.isLg() || this.isXl() || this.is2Xl()) {
                    return true;
                }
                break;
        
            default:
                break;
        }
            
        return false;
    }

    getDevice() {
        if(this.isXs() || this.isSm()) {
            return 'phone';
        }
        
        if(this.isMd()) {
            return 'tablet';
        }

        if(this.isLg()) {
            return 'pc-sm';
        }

        if(this.isXl()) {
            return 'pc-md';
        }

        if(this.is2Xl()) {
            return 'pc-lg';
        }
    }
}

export { TailwindScreen }