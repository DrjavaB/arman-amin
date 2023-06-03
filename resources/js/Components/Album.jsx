import React from 'react';
import {Swiper, SwiperSlide} from "swiper/react";
import {Autoplay} from "swiper";

import "swiper/css";

function Album({list}) {
    return (
        <>
            <Swiper
                className="mySwiper"
                autoplay={{
                    delay: 2500,
                    disableOnInteraction: false,
                }}
                modules={[Autoplay]}
            >
                {list.map((link, index) =>
                    <SwiperSlide key={index}>
                        <img src={link} alt={link} className='w-36 h-auto object-cover rounded'/>
                    </SwiperSlide>
                )}
            </Swiper>
        </>
    );
}

export default Album;
