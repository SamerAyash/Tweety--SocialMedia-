<template>
    <div class="d-flex p-3 border-bottom " v-for='tweet in this.tweets'>
        <div class="px-4"><!--
            <a href="{{tweet.user.profilePath()}}">
                <img src="{{$tweet->user->getAvatar(tweet.user.avatar)}}" width="50" class="rounded-circle">
            </a>-->
        </div>
        <div>
            <div class=" mb-2">
                <a href="">
                    <h5 class="font-weight-bolder">{{tweet.user.name}}</h5>
                </a>
                <h6 class="small text-muted">{{tweet.created_at}}</h6>
            </div>
            <p class="pr-4" style="word-break: break-word;font-size: 12px;font-weight: 600">
                {{tweet.body}}
            </p>
            <div class="d-flex justify-content-start">
            <span class="mr-4">
                <form action="" method="POST">
                    @csrf
                <button class="submitBut" type="submit">
                    <i class="fa fa-thumbs fa-thumbs-up
                    <?php $tweet->isLikedBy(auth()->user())?print 'text-primary':''?>">
                        {{tweet.likes? tweet.likes:0}}
                    </i>
                </button>
                </form>
            </span>
                <span>
                <form action="" method="POST">
                    @csrf
                <button class="submitBut" type="submit">
                    <i class="fa fa-thumbs fa-thumbs-down
                    <?php $tweet->isDislikedBy(auth()->user())?print 'text-danger':''?>">
                        {{tweet.dislikes?tweet.dislikes:0}}
                    </i>
                </button>
                </form>
            </span>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "tweet_component",
        props:{
            tweet_profile:{
                type:Boolean,
                required:true
            },
            user_id:{
                type: Number,
                required: true
            }
        },
        data(){
            return {
                tweets:[],
            }
        },
        methods:{
            getTweets(){
                axios.post('/tweets/getTweet',{
                    tweet_profile:this.tweet_profile,
                    user_id:this.user_id
                })
                .then(res=>{
                    this.tweets= res.data.data;
                    console.log(res.data.data);
                })
                .catch(err=>{
                });

            }
        },
        mounted(){
            this.getTweets();
        },
    }
</script>

<style scoped>
    .fa-thumbs{
        color: darkgray;
    }
    .submitBut{
        background: transparent;
        box-shadow: 0px 0px 0px transparent;
        border: 0px solid transparent;
        text-shadow: 0px 0px 0px transparent;

    }
</style>
