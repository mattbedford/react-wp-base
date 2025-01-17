import countImage from '../assets/count.jpg';
const Imager = () => {


    const num1 = 10;
    const num2 = 20;

    return (
        <>
            <img src={countImage} alt="random image" />
            <p>Our component returned the value of {num1 + num2}</p>
            <h3>I am awesome</h3>
        </>
    )
}

export default Imager;