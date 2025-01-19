const Imager = () => {


    const useState = wp.element.useState;

    const [img, setImg] = useState(null);
    const [theme, setTheme] = useState("");

    const handleChange = (event) => {
        setTheme(event.target.value); // Update the state with the selected value
    };

    const getRandomImage = (event) => {
        event.preventDefault();
        wp.apiFetch({
            path: '/react-base/v1/get-images',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            data: {theme: theme}
        })
            .then((response) => {
                const base64Image = response.img;
                const randomImg = `data:image/png;base64,${base64Image}`;
                setImg(randomImg);
            })
            .catch((error) => {
                console.error('Error fetching image:', error); // Error handling
            });
    }


    return (
        <>
            <h3>Generate a random image</h3>
            {img && <img src={img} alt="random image" />}
            <form onSubmit={getRandomImage}>
                <select onChange={handleChange}>
                    <option value="">Choose a theme</option>
                    <option value="nature">Nature</option>
                    <option value="city">City</option>
                    <option value="technology">Tech</option>
                    <option value="food">Food</option>
                    <option value="still_life">Still life</option>
                    <option value="abstract">Abstract</option>
                </select>
                <input type="submit" value="Generate" />
            </form>

        </>
    )
}

export default Imager;